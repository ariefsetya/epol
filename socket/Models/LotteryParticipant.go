package Models

import (
	"socket/Config"
	"socket/Structs"

	_ "github.com/go-sql-driver/mysql"
)

func GetByQRCode(lpm *Structs.LotteryParticipantMain, id string, category_id string) (err error) {
	if err = Config.DB.Where("`number` = ?", id).Where("category_id = ?", category_id).First(lpm).Error; err != nil {
		return err
	}
	return nil
}

func GetAllParticipant(lpm *[]Structs.LotteryParticipantTableData) (err error) {
	if err = Config.DB.Select("*, CASE WHEN category_id = 1 THEN 'Gold' ELSE 'Silver' END as category_name").Find(lpm).Error; err != nil {
		return err
	}
	return nil
}

func GetAllParticipantCategory(lpcm *[]Structs.LotteryParticipantCategoryMain) (err error) {
	if err = Config.DB.Find(lpcm).Error; err != nil {
		return err
	}
	return nil
}