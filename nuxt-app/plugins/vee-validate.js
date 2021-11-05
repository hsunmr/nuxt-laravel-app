import { extend } from "vee-validate";
import { required, email } from "vee-validate/dist/rules";
import { localize } from 'vee-validate';
import zh_TW from 'vee-validate/dist/locale/zh_TW.json';


extend("required", {
    ...required,
});

extend("email", {
    ...email,
});

localize('zh_TW', zh_TW);