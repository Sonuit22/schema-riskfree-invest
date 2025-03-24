*{
    z-index: 100;
}


.chat{
    position: relative;
    left: -2vw;
    top: 20vh;
    border-radius: 100px;
}
#chat-box { 
   background-color:gray;
    width: 100%; 
    height: 490px;
    overflow-y: auto;
    border: 1px solid #ccc; 
    padding: 10px;
     z-index: 10;
     }
#user-input { 
    position:relative;
    top:20%;
    width: 80%;
    padding: 10px;
 }
#send-btn {
    position:absolute;
    width:70px;
    left:80%;
    bottom:22px;
    padding: 10px;
    cursor: pointer; 
 }

#chat-container {
    position: fixed;
    top: 3vh;
    bottom: 20px;
    right: -700px;
    width: 400px;
    height: 600px;
    background: white;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: right 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    z-index: 10;
}
#chat-header {
    background: #007bff;
    color: white;
    padding: 10px;
    text-align: center;
    cursor: pointer;
}
#chat-body {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
}
#chat-input {
    padding: 10px;
     
 
    border: none;
    width: 100%;
    box-sizing: border-box;
    border-top: 1px solid #ccc;
}
#close-chat {
    height:20px;
    width:20px;
    float: right;
    cursor: pointer;
    background-color:red;
}
    #botimg {
        position: relative;
        top: 20vh;
    border-radius: 20px;
      height: 100px;
        }