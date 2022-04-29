
const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

//form.onsubmit = (e)=>{
//    e.preventDefault();
//    var $form =$(this),
//    url = $form.attr('action');
//    var action = 'send_message';
//    var posting = $.post(url, {
//        incoming_id: $('.incoming_id').val(),
//        message: $('.message').val(),
//        action:action  
//    });
//    posting.done(function(data){
//       $('.incoming_id').val('');
//        $('.message').val('');
//    });
//}


$('form').submit(function(event){
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var action = 'send_message';
    insert_user(url, action);
});
function insert_user(url,action){
    var post = $.post(url, {
        incoming_id: $('.incoming_id').val(),
        message: $('.message').val(),
        action:action
    
    });
    post.done(function(data){
        $('.msg').text(data);
        $('.incoming_id').val('');
        $('.message').val('');
    });
}

   

//inputField.focus();
//inputField.onkeyup = ()=>{
//    if(inputField.value != ""){
//        sendBtn.classList.add("active");
//    }else{
//        sendBtn.classList.remove("active");
//    }
//}
//
//
//sendBtn.onclick = ()=>{
//    let xhr = new XMLHttpRequest();
//    xhr.open("POST", "crud.php", true);
//    
//    xhr.onload = ()=>{
//      if(xhr.readyState === XMLHttpRequest.DONE){
//          if(xhr.status === 200){
//            let data = xhr.response;
//              inputField.value = "";
//              scrollToBottom();
//          }
//      }
//    }
//    let formData = new FormData(form);
//    xhr.send(formData);
//}
//
//chatBox.onmouseenter = ()=>{
//    chatBox.classList.add("active");
//}
//
//chatBox.onmouseleave = ()=>{
//    chatBox.classList.remove("active");
//}
//
//
////setInterval(() =>{
////  let xhr = new XMLHttpRequest();
////  xhr.open("POST", "crud.php", true);
////  xhr.onload = ()=>{
////    if(xhr.readyState === XMLHttpRequest.DONE){
////        if(xhr.status === 200){
////          let data = xhr.response;
////          console.log(data);
////          chatBox.innerHTML = data;
////            if(!chatBox.classList.contains("active")){
////                scrollToBottom();
////              }
////          }
//      }
//    }
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //xhr.send("incoming_id="+incoming_id);
    //let formData = new FormData(form);
    //xhr.send(formData);
//}1000);


//function scrollToBottom(){
//    chatBox.scrollTop = chatBox.scrollHeight;
//  }
  