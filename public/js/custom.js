let connection = new autobahn.Connection({url: 'ws://127.0.0.1:9090/', realm: 'realm1'});
console.log("hello");
connection.onopen = function (session) {
   function onevent(args) {
      console.log("Event:", args[0]);
  }
  function onMessageRecieve(msg){
    document.getElementById("chatman").innerHTML += '<li>' + msg[0]["text"] + '</li>';
    console.log(msg);
    $.ajax({
        type:'POST',
        url:'/',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{"name":msg[0]["name"],"text":msg[0]["text"]},
    }).then((data,stts,xhr)=>{
        console.log("done_post",stts,data);});
}
session.subscribe('com.myapp.hello', onevent);

session.publish('com.myapp.hello', ['new connection!']);
// connection.session.subscribe('com.myapp.message',onMessageRecieve);
connection.session.subscribe('com.myapp.message',onMessageRecieve);
}
let time = (function() {
  let prev = Date.now();
  let now = "";
  return {
    count: function() {
       return now = Date.now() - prev;
   },
   upd: function() {
      prev = Date.now();
  }
};
})();
///////////////////////////////
function chat(){

    const msg = {};
    msg["name"] = document.getElementById("txt1").value || "nanashi";
    msg["mail"] = document.getElementById("txt2").value || "mail";
    msg["text"] = document.getElementById("txt3").value || "nashi";
    console.log(time.count());
    if(msg["text"] != "nashi" && time.count() > 1000){
        time.upd();
        connection.session.publish('com.myapp.message',[msg],null,{exclude_me: false});
        //jqueryでpost
    }
}
///////////////////////////////
connection.open();