export class FormValidation {
    constructor() {
        FormValidation.mounted();
    }
    
    static MobileVarified = false;
    static NumberVarified = false;
    
    static mounted()
    {
        let form    = document.querySelector("#order-form");
        let socket  = form.dataset.socket;
        
        // Transform Address
        this.AsSameAddress();
        
        // Mobile Number validation
        this.MobileValidation();
        
        // Matching Number
        this.NumberMatch();
        
        // Submit Action
        this.Submit(form, socket);
    }
    static AsSameAddress()
    {
        let same    = document.querySelector("#same");
        let sopping = document.querySelector("#sopping");
        let address = document.querySelector("#address");
        
        same.addEventListener("click", ()=>{
            if(same.checked){
                sopping.value = address.value;
            }
            else{
                sopping.value = "";
            }
        });
    }
    
    // Number varification
    static NumberMatch()
    {
        /*let result_input    = document.querySelector("#result_input");
        let blum            = result_input.dataset.blum;
        let conditon        = false;
        
        // Checking
        result_input.addEventListener("input", ()=>{
            if(atob(blum) == result_input.value){
                this.NumberVarified = true;
            }else{
                this.NumberVarified = false;
            }
        });*/
        this.NumberVarified = true;
        
        return true;
    }
    
    // Mobile Number validation
    static MobileValidation()
    {
        let mobile_tag          = document.querySelector('#mobile_no');
        let mobile_no           = '';
        let number_Validation   = false;
        
        mobile_tag.addEventListener("input", ()=>{
            
            mobile_no = mobile_tag.value;
            if(mobile_no.length == 11) 
            {
                this.MobileVarified = number_Validation = this.PhoneNumberCheck(mobile_no);
            }
            else if(mobile_no.length == 14) 
            {
                this.MobileVarified = number_Validation = this.PhoneNumberCheck(this.CountryCode(mobile_no));
            }
            
        });
        return number_Validation;
    }
    
    // Bangli Country code checking
    static CountryCode(mobile_no) 
    {
        let condition = false;
        let countryCode = mobile_no.slice(0, 3);
        if(countryCode == +88){
            condition = mobile_no.slice(3)
        }
        return condition;
    }
    
    // Bangli phone oparator check
    static PhoneNumberCheck(phone_no) {
        let varified = false;
        if(phone_no){
            let oparator_code   = phone_no.slice(0, 3);
            let oparators       =  ['011','013','014','015','016','017','018','019'];
            oparators.forEach((oparator)=>{
                if(oparator == oparator_code) {
                    varified = true;
                }
            });
        }
        return varified;
    }
    
    // Submit Action
    static Submit(form, socket){
        form.addEventListener("submit", ()=>{
            let token   = document.createElement("input");
            
            // Name Attribute
            let name    = document.createAttribute("name");
            name.value  = "_token";
            
            // hidden Attribute
            let hidden    = document.createAttribute("type");
            hidden.value  = "hidden";
            
            token.setAttributeNode(name);
            token.setAttributeNode(hidden);
            
            // Value Attribute
            let value    = document.createAttribute("value");
            
            let validate_json;
            
            if(this.MobileVarified && this.NumberVarified)
            {
                validate_json = btoa('{\"mobileVarified\":\"true\",\"number_varified\":\"true\"}');
            }
            else if(this.MobileVarified)
            {
                validate_json = btoa('{\"mobileVarified\":\"true\",\"number_varified\":\"false\"}');
            }
            else if(this.NumberVarified)
            {
                validate_json = btoa('{\"mobileVarified\":\"false\",\"number_varified\":\"true\"}');
            }
            else
            {
                validate_json = btoa('{\"mobileVarified\":\"false\",\"number_varified\":\"false\"}')
            }
            
            value.value = validate_json;
            token.setAttributeNode(value);
            form.append(token);
            
            // Form Acton
            form.setAttribute('action', atob(socket));
            form.setAttribute('method', "POST");
            
            form.submit();
        });
        
    }
}

