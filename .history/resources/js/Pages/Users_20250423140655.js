import axios from "axios";
import Swal from "sweetalert2";

export class Users {
    constructor() {
        this.load();

    };

    load() {
        this.events();
        $("#usersTable").dataTable();
    }

    events() {
        let self = this;


    }



}
