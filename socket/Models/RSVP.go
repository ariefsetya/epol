package Models

import (
	"socket/Config"
	"socket/Structs"

	_ "github.com/go-sql-driver/mysql"
)

func GetRSVPByUserId(rsvp *Structs.RSVPMain, id string) (err error) {
	if err = Config.DB.Where("`user_id` = ?", id).First(rsvp).Error; err != nil {
		return err
	}
	return nil
}
