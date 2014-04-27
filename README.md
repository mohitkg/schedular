Course Project for CS315 : DataBase Management, Spring Semester 2014. 
Academic And Personal Schedule Manager
DataBase Name : acadScheduler
Collections :
 	courses -
 		"instructor_name" , "course_name" , "timing", "days" , "students" 
 	schedule
 		"name", "M" : ["timing", "course_name"] "T" ...... 

db.schedule.insert({"name" : "test instructor", "M" : [], "T" : [], "W" : [], "Th" : [], "F" : []})
