# api
POST ACTION API

How to use?
1. SELECT operation with join tables

params :
{
  "s.wo_status_id":"w.wo_status_id",
  "wo_number":"WO20190408-024733-72"
}
table_name : work_orders w,wo_status s
operation : SELECT
action : crud


Example Results:

[
    {
        "wo_id": "333",
        "wo_number": "WO20190408-024733-722",
        "wo_name": "Screw Torque Calibration",
        "created_date_time": "2019-04-08 14:49:10",
        "created_by": "1",
        "priority_id": "1",
        "wo_status_id": "5",
        "wo_category_id": "2",
        "description": "To calibrate screw torque",
        "instruction": "Please read manual",
        "site_no": "1",
        "assigned_to": "1",
        "required_start_date_time": "2018-06-12 19:30:00",
        "required_end_date_time": "2018-06-12 19:30:00",
        "duration": "1",
        "status_name": "CLOSED"
    }
]
