package Structs

type PresenceMain struct {
	Id      					string  `json:"id"`
	EventId 					string 	`json:"event_id"`
	UserId				 		string 	`json:"user_id"`
	Via 						string 	`json:"via"`
	ViaInfo 					string 	`json:"via_info"`
	CreatedAt   				string 	`json:"created_at"`
	UpdatedAt 					string 	`json:"updated_at"`
}

func (b *PresenceMain) TableName() string {
	return "presences"
}
