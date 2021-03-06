package Models

import (
	"socket/Config"
	"socket/Structs"

	_ "github.com/go-sql-driver/mysql"
)

func CreateLotteryHistory(lh *Structs.LotteryHistoryMain) (err error) {
	if err = Config.DB.Create(lh).Error; err != nil {
		return err
	}
	return nil
}