package Structs

type LotteryParticipantTableHeader struct {
	Name		string  	`json:"name"`
	Title 		string		`json:"title"`
	Sortable	bool		`json:"sortable"`
}

type LotteryParticipantTableData struct {
	Number 		string 		`json:"number"`
	Name		string 		`json:"name"`
	City		string 		`json:"city"`
	CategoryName	string 		`json:"category_name"`
}
func (b *LotteryParticipantTableData) TableName() string {
	return "lottery_participants"
}


type LotteryParticipantTable struct {
	Header		[]LotteryParticipantTableHeader   	`json:"header"`
	Data 		[]LotteryParticipantTableData			`json:"data"`
}