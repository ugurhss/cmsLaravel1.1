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

            //butona tıklandığında saveUserBtn classı tetiklenecek
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
        const userdata = { //aldıgın degerleri userdataya atadık
            name_surname: $(".name_surname").val(),
            email: $(".email").val(),
            phone: $(".phone").val(),
            password: $(".password").val(),
            password_rep: $(".password_rep").val(),
            status: $(".status").val(),
            user_id: $(".user_id").val(),
        };
        console.log(userdata);
        const { data } = await axios.post("/api/users/createUser", userdata); //backend deki createUser fonksiyonuna gidecek
        if (data && data.status) {
            Swal.fire({
                title: "Bilgi",
                text: data.message,// data message loginclass dan geldi ve swal alert2 de gösterildi
                icon: "success",
            }).then(() => {
                window.location.href = "/users";// sayfa yenilenecek
            });
        } else {
            Swal.fire("Hata", data.message, "error");
        }
    }


}
