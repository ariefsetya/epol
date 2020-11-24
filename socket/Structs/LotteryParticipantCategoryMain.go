package Structs

type LotteryParticipantCategoryMain struct {
	Id      	string  `json:"id"`
	Name 		string 	`json:"name"`
	CreatedAt   string 	`json:"created_at"`
	UpdatedAt 	string 	`json:"updated_at"`
}

func (b *LotteryParticipantCategoryMain) TableName() string {
	return "lottery_participant_categories"
}
