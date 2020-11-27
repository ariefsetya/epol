package main

import (
	"net/http"
	"socket/Structs"
	"socket/Config"
	"fmt"
	"socket/Models"

	"github.com/gin-gonic/gin"
	"github.com/gin-gonic/autotls"
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


	var lpcm []Structs.LotteryParticipantCategoryMain
	err := Models.GetAllParticipantCategory(&lpcm)
	if err != nil {
		fmt.Println("info:", err)
	} else {

		for _, n := range lpcm {
			fmt.Println("info:", "category set: " + "scan-" + n.Id)
			server.OnEvent("/", "scan-"+n.Id, func(s socketio.Conn, msg string) string {

				var lpm Structs.LotteryParticipantMain
				fmt.Println("data:", msg);
				err := Models.GetByQRCode(&lpm, msg, n.Id)
				fmt.Println("result:", err);
				if err != nil {
					fmt.Println("error:", err);
					return "Data Not Found"
				} else {


					var lh Structs.LotteryHistoryMain
					lh.LotteryParticipantId = lpm.Id
					lh.Status = true

					err := Models.CreateLotteryHistory(&lh)

					if err != nil {
						fmt.Println("error:", err);
						return "Data Not Saved"
					} else {

						var result = lpm.Number + "-" + lpm.Name + "-" + lpm.City + "-" + msg
						fmt.Println("result:", lpm);

						server.BroadcastToRoom("", "bcast", "display", result)
						return result
					}
				}
			})
		}
	}

	server.OnEvent("/", "winners", func(s socketio.Conn, msg string) string {
		server.BroadcastToRoom("", "bcast", "initialize", msg)
		return "initialized";
	})
	server.OnEvent("/", "start", func(s socketio.Conn, msg string) string {
		server.BroadcastToRoom("", "bcast", "start", msg)
		return "started";
	})

	server.OnError("/", func(s socketio.Conn, e error) {
		fmt.Println("meet error:", e)
	})

	server.OnDisconnect("/", func(s socketio.Conn, reason string) {
		fmt.Println("closed", reason)
	})

	go server.Serve()
	defer server.Close()

	router.Use(GinMiddleware("http://aqua-japan.com:8000"))
		router.GET("/socket.io/*any", gin.WrapH(server))
		router.POST("/socket.io/*any", gin.WrapH(server))
		router.StaticFS("/public", http.Dir("../asset"))
		router.GET("/table_data/participant/list", func(c *gin.Context) {
			var lptd []Structs.LotteryParticipantTableData
			err := Models.GetAllParticipant(&lptd)
			if err != nil {
				c.AbortWithStatus(http.StatusNotFound)
			} else {
				table := Structs.LotteryParticipantTable{
					Header: []Structs.LotteryParticipantTableHeader{
						Structs.LotteryParticipantTableHeader{
							Name: "number",
							Title: "Number",
							Sortable: true,
						},
						Structs.LotteryParticipantTableHeader{
							Name: "name",
							Title: "Name",
							Sortable: true,
						},
						Structs.LotteryParticipantTableHeader{
							Name: "city",
							Title: "City",
							Sortable: true,
						},
						Structs.LotteryParticipantTableHeader{
							Name: "category_name",
							Title: "Category",
							Sortable: true,
						},
					},
					Data: lptd,
				}


				c.JSON(http.StatusOK, table)
			}
		})

		// router.Run("localhost:3000")
		log.Fatal(autotls.Run(router, "faraakbarwedding.com:3000"))

	}