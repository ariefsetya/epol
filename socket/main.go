package main

import (
	"net/http"
	"socket/Structs"
	"socket/Config"
	"fmt"
	"socket/Models"

	"github.com/gin-gonic/gin"
	"github.com/jinzhu/gorm"

	socketio "github.com/googollee/go-socket.io"
)


func GinMiddleware(allowOrigin string) gin.HandlerFunc {
	return func(c *gin.Context) {
		c.Writer.Header().Set("Access-Control-Allow-Origin", allowOrigin)
		c.Writer.Header().Set("Access-Control-Allow-Credentials", "true")
		c.Writer.Header().Set("Access-Control-Allow-Methods", "POST, OPTIONS, GET, PUT, DELETE")
		c.Writer.Header().Set("Access-Control-Allow-Headers", "Accept, Authorization, Content-Type, Content-Length, X-CSRF-Token, Token, session, Origin, Host, Connection, Accept-Encoding, Accept-Language, X-Requested-With")


		if c.Request.Method == "OPTIONS" {
			c.AbortWithStatus(204)
			return
		}

		c.Request.Header.Del("Origin")

		c.Next()
	}
}

func main() {


	Config.DB, _ = gorm.Open("mysql", Config.DbURL(Config.BuildDBConfig()))

	defer Config.DB.Close()

	router := gin.New()

	server, _ := socketio.NewServer(nil)

	server.OnConnect("/", func(s socketio.Conn) error {
		s.SetContext("")
		s.Join("bcast")
		fmt.Println("connected:", s.ID())
		return nil
	})
	server.OnEvent("/", "scan-gold", func(s socketio.Conn, msg string) string {

		var lpm Structs.LotteryParticipantMain
		err := Models.GetByQRCode(&lpm, msg, "1")
		if err != nil {
			return msg
		} else {
			return lpm.Number + "-" + lpm.Name + "-" + lpm.City + "-" + msg
		}

	})

	server.OnEvent("/", "data", func(s socketio.Conn, msg string) {
		server.BroadcastToRoom("", "bcast", "display", msg)
		fmt.Println("display:", msg)
		//s.Emit("display", msg);
	})

	server.OnEvent("/", "scan-silver", func(s socketio.Conn, msg string) string {

		var lpm Structs.LotteryParticipantMain
		err := Models.GetByQRCode(&lpm, msg, "2")
		if err != nil {
			return msg
		} else {			
			return lpm.Number + "-" + lpm.Name + "-" + lpm.City + "-" + msg
		}

	})

	server.OnError("/", func(s socketio.Conn, e error) {
		fmt.Println("meet error:", e)
	})

	server.OnDisconnect("/", func(s socketio.Conn, reason string) {
		fmt.Println("closed", reason)
	})

	go server.Serve()
	defer server.Close()

	router.Use(GinMiddleware("http://localhost"))
		router.GET("/socket.io/*any", gin.WrapH(server))
		router.POST("/socket.io/*any", gin.WrapH(server))
		router.StaticFS("/public", http.Dir("../asset"))

		router.Run("localhost:3000")
	}