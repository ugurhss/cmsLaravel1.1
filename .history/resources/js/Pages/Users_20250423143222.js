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

    index(){
        $("#usersTable").dataTable();
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/users',
            type: 'GET',
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action'}
        ],
    }




}
