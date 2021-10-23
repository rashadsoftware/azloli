const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
};

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
};
/*
sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "insert", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
};

$("#chatForm").on("submit", function (e) {
    e.preventDefault();

    // change profile optional
    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "ok") {
                inputField.value = "";
                scrollToBottom();
            }
        },
    });
});
*/
chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
};

/*
setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "{{ route('chat.get') }}", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);
*/

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
