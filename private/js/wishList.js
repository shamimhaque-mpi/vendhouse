var site_url = url.replace('frontend/ajax/', '');
var user_id  = null;
class wishList {
    constructor(id=null){
        user_id = id;
        this.xml(url+'wishListids', {
            user_id    : user_id
        });
    }
    // Add To Wish List
    addToWishList(product_id){
        window.event.preventDefault();
        if(user_id){
            this.xml(url+'addToWish', {
                product_id : product_id,
                user_id    : user_id
            });
        }else{
            window.location.href=site_url+'login';
        }
    }
        
    xml(url, data=null){
        var formData = new FormData();
        if(data){
            for(const key in data){
                formData.append(key, data[key]);
            }
        }
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                document.querySelector('#count').innerText = response.count;
                wishList.active(response.ids, data.product_id);
            }
        };
        xhttp.open("POST", url, true);
        xhttp.send(formData);
    }
    
    static active(ids=null, reid=null){
        var tag = null;
        if(reid){
            tag = document.querySelectorAll('.active_'+reid);
            if(tag){
                Object.values(tag).forEach((val)=>{
                    val.classList.remove('active');
                });
            }
        }
        if(ids){
            Object.values(ids).forEach((id)=>{
                tag = document.querySelectorAll('.active_'+id);
                if(tag){
                    Object.values(tag).forEach((val)=>{
                        val.classList.add('active');
                    });
                }
            });
        }
    }
}