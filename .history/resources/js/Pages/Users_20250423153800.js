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
        $("body")
        .on("click", ".saveUserBtn", function () {
            self.saveUser();
        })


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
                {data: 'name', name: 'name'},//backend deki name ile eşleşiyor name frontend deki name ile eşleşiyor
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'}
            ],
        });
    }

    async saveUser() {
        const userdata = {
            name_surname: $(".name_surname").val(),
            email: $(".email").val(),
            phone: $(".phone").val(),
            password: $(".password").val(),
            password_rep: $(".password_rep").val(),
            status: $(".status").val(),
            user_id: $(".user_id").val(),
        };
        const { data } = await axios.post("/api/users/saveUser", userdata);
        if (data && data.status) {
            Swal.fire({
                title: "Bilgi",
                text: data.message,
                icon: "success",
            }).then(() => {
                window.location.href = "/users";
            });
        } else {
            Swal.fire("Hata", data.message, "error");
        }
    }


}
