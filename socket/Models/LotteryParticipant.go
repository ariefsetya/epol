package Models

import (
	"socket/Config"
	"socket/Structs"

	_ "github.com/go-sql-driver/mysql"
)
func GetByQRCode(lpm *Structs.LotteryParticipantMain, id string, category_id string) (err error) {
	if err = Config.DB.Where("id = ?", id).Where("category_id = ?", category_id).First(lpm).Error; err != nil {
		return err
	}
	return nil
}