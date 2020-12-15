package Models

import (
	"socket/Config"
	"socket/Structs"

	_ "github.com/go-sql-driver/mysql"
)

func GetUserByQRCode(lpm *Structs.UserMain, code string) (err error) {
	if err = Config.DB.Where("`reg_number` = ?", code).First(lpm).Error; err != nil {
		return err
	}
	return nil
}
