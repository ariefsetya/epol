package Structs

type UserMain struct {
	Id      					string  `json:"id"`
	EventId 					string 	`json:"event_id"`
	UserTypeId				 	string 	`json:"user_type_id"`
	CountryId				 	string 	`json:"country_id"`
	RegNumber 					string 	`json:"reg_number"`
	Name 	 					string 	`json:"name"`
	Email 	 					string 	`json:"email"`
	Phone 	 					string 	`json:"phone"`
	Company 	 				string 	`json:"company"`
	CustomField1 	 			string 	`json:"custom_field_1"`
	CustomField2 				string 	`json:"custom_field_2"`
	CustomField3 	 			string 	`json:"custom_field_3"`
	NeedLogin   				bool 	`json:"need_login"`
	CreatedAt   				string 	`json:"created_at"`
	UpdatedAt 					string 	`json:"updated_at"`
}

func (b *UserMain) TableName() string {
	return "users"
}
