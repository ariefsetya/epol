package Structs

type RSVPMain struct {
	Id      					string   	`json:"id"`
	EventId 					string 	`json:"event_id"`
	UserId				 		string 	`json:"user_id"`
	SeatNumber 					string 	`json:"seat_number"`
	GuestQty 	 				string 	`json:"guest_qty"`
	ConfirmStatus 	 			string 	`json:"confirm_status"`
	SessionInvitation 	 		string 	`json:"session_invitation"`
	EventTime 	 				string 	`json:"event_time"`
	AddressLocation 	 		string 	`json:"address_location"`
	CreatedAt   				string 	`json:"created_at"`
	UpdatedAt 					string 	`json:"updated_at"`
}

func (b *RSVPMain) TableName() string {
	return "r_s_v_p_s"
}
