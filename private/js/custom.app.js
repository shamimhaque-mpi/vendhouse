var d_ = (x)=>document.querySelector(x);
var dAll = (x)=>document.querySelectorAll(x);
var formData = new FormData();

d_('button[data-get_code').addEventListener('click', ()=>{
    var mobile = d_('input[data-mobile]').value;
    if(mobile.length > 10){
        formData.append('mobile', mobile);
        http(formData);
    }
});

d_('button[data-verify]').addEventListener('click', ()=>{
    var code = d_('input[data-code]').value;
    formData.append('code', code);
    http(formData);
});

d_('button[data-set_password]').addEventListener('click', ()=>{
    var password = d_('input[data-password]').value;
    formData.append('password', password);
    http(formData);
});

function http(data=null){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          domManage(this.responseText);
        }
    };
    xhttp.open("POST", window.location.origin+'/reset_password', true);
    xhttp.send(data);
}

function domManage(niddle){
    d_('#msg').innerTex="Reset Password";
    var options = dAll('.options');
    if(niddle=='success'){
        d_('#msg').innerTex="Successfully Changed";
        window.location.href = window.location.origin+'/login?msg=Your Password Successfully Changed'; 
    }
    else if(niddle!='code' && niddle!='mobile' && niddle!='password'){
        d_('#msg').innerText=niddle;
    }
    else if(options){
        Object.values(options).forEach((tag)=>{
            tag.style.display = 'none';
            if(tag.dataset.option==niddle){
                tag.style.display = '';
            }
        });
    }
}