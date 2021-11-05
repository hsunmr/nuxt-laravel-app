import Vue from "vue";
import Swal from 'sweetalert2';

Vue.use({
    install (Vue, options) {
        Vue.prototype.swal = Swal;
    }
}, {});