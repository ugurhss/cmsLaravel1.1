import axios from "axios";
import Swal from "sweetalert2";

export class Users {
    constructor() {
        this.load();

    };

    load() {
        this.events();
        // $("#usersTable").dataTable();
        this.index();

    }

    events() {
        let self = this;


    }

    index() {
        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/users',
                type: 'GET',
            },
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'}
            ],
        });
    }




}
