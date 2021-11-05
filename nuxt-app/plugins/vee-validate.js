import { extend } from "vee-validate";
import { required, email, confirmed } from "vee-validate/dist/rules";
import { localize } from 'vee-validate';
import zh_TW from 'vee-validate/dist/locale/zh_TW.json';


extend("required", {
    ...required,
});

extend("email", {
    ...email,
});

extend("confirmed", {
    ...confirmed,
    message : '密碼不一致。'
});


localize('zh_TW', zh_TW);