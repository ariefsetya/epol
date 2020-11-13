package Structs

type LotteryParticipantMain struct {
	Id      	uint   	`json:"id"`
	CategoryId  uint 	`json:"category_id"`
	Number   	string 	`json:"number"`
	Name 		string 	`json:"name"`
	City 		string 	`json:"city"`
	CreatedAt   string 	`json:"created_at"`
	UpdatedAt 	string 	`json:"updated_at"`
}

func (b *LotteryParticipantMain) TableName() string {
	return "lottery_participants"
}
