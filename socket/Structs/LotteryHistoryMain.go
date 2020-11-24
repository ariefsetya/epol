package Structs

type LotteryHistoryMain struct {
	Id      					uint   	`json:"id"`
	LotteryParticipantId 		uint 	`json:"lottery_participant_id"`
	Status 						bool 	`json:"status"`
	CreatedAt   				string 	`json:"created_at"`
	UpdatedAt 					string 	`json:"updated_at"`
}

func (b *LotteryHistoryMain) TableName() string {
	return "lottery_histories"
}
