<?php
//My reply
function myReply($message){
    if($message=="指令"){
    $message_to_reply = "你可以跟我打招呼或是問我是誰";
    }else if(($message=="hi")||($message=="妳好")||($message=="你好")){
        $hi = array("HI~", "你好。", "哈囉！"); 
        $num = rand(0,2);
        $message_to_reply = $hi[$num]."最近好嗎？".$num;
    }else if($message=="你是誰"){
        $message_to_reply = "我是Yu-Bot，我還在學習中。";
    }else{
        //重複使用者說的話
        $message_to_reply = $message;
    }
    return $message_to_reply;
}


//此處的quick_replies 是對話視窗下會出現的快速鍵
// type 有 text,location,image
function reply($sender,$message_to_reply){
    if($message_to_reply=="我要搭高雄捷運"){
        $jsonData = '{
            "recipient":{
                "id":"'.$sender.'"
            },
            "message":{
                "attachment":{
                  "type":"image",
                  "payload":{
                    "url":"https://fbbot-haoyushi.c9users.io/pic/guide_routemap.png"
                  }
                }
            }
        }';
    }else if($message_to_reply=="我要搭台北捷運"){
        $jsonData = '{
            "recipient":{
                "id":"'.$sender.'"
            },
            "message":{
                "attachment":{
                  "type":"image",
                  "payload":{
                    "url":"https://fbbot-haoyushi.c9users.io/pic/routemap2017.jpg"
                  }
                },
                "quick_replies":[
                  {
                    "content_type":"text",
                    "title":"HI",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_RED"
                  },
                  {
                    "content_type":"text",
                    "title":"你是誰",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_GREEN"
                  },
                  {
                    "content_type":"text",
                    "title":"我要搭高雄捷運",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_GREEN"
                  },{
                    "content_type":"text",
                    "title":"我要搭台北捷運",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_GREEN"
                  },{
                    "content_type":"location",
                  }
                ]
            }
        }';
    }else{
        $jsonData = '{
            "recipient":{
                "id":"'.$sender.'"
            },
            "message":{
                "text":"'.$message_to_reply.'",
                "quick_replies":[
                  {
                    "content_type":"text",
                    "title":"HI",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_RED"
                  },
                  {
                    "content_type":"text",
                    "title":"你是誰",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_GREEN"
                  },
                  {
                    "content_type":"text",
                    "title":"我要搭高雄捷運",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_GREEN"
                  },{
                    "content_type":"text",
                    "title":"我要搭台北捷運",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_GREEN"
                  },{
                    "content_type":"location",
                  }
                ]
            }
        }';
    }
    
    return $jsonData;
}



?>
