var adminJS = () => {
    /**
     * Register user page handler
     */
    var initAdminRegisterUser = function(){
        /*
        **  Faculty representative helper
        **  Reveals a faculty dropdown if the role of added user is a faculty representative
        **  
        */
        let role = document.querySelector('select[name="role"]');
        let faculty = document.querySelector('#faculty-select');

        if (role.value == "faculty representative") {
            faculty.classList.remove('hidden');
        } else {
            faculty.classList.add('hidden');
        }
        role.addEventListener('change', function () {
            var faculty = document.querySelector('#faculty-select');
            if (role.value == "faculty representative") {
                faculty.classList.remove('hidden');
            } else {
                faculty.classList.add('hidden');
            }    
        });

       /*
        ** Add faculty option
        */
        let btnAddNewFaculty = document.querySelector('#addNewFaculty');
        
        btnAddNewFaculty.addEventListener('click',function(event){
            event.preventDefault();
            $('#addFacultyModal').modal('show');                
        },false);

        let addFaculty = document.querySelector('#addFaculty');
        addFaculty.addEventListener('click',function(event){
            event.preventDefault();
            let facultyName = $("#facultyName").val();
            let url = $("#facultyName").closest('form').action;
            $.ajax({
                method:"POST",
                url: url,
                data: {name: facultyName }
            }).done( ()=> {
                $('#addFacultyModal').modal('hide');
                swal({
                    title: "Success",
                    text: "Faculty added",
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000
                });            
            }).fail( () =>{
                swal({
                    title: "Could not update faculty",
                    text: "Try again later",
                    type: "warning",
                    showConfirmButton: false,
                    timer: 2000
                }); 
                $('#addFacultyModal').modal('hide');
            });
        });

        $('#addFacultyModal').on('hidden.bs.modal', function (){
            $("#facultyName").val(' ');
        });

       /*
        ** Update the faculties from the database
        */
        let fetchUrl = $("select[name=faculty]").data('source');
        
        /**
        * 
        * @param {Array} data The faculty information to be inserted
        */
        function fillFaculties(data) {
            data.forEach(element => {
                var option = '<option value="' + element["id"] + '"<?php echo  set_select("faculty", '+element["name"]+', TRUE); ?>'+element['name']+'</option>';
                $( document.querySelector("select[name=faculty]") ).append(option);
            });
        }
        
        $.post(fetchUrl,function(data){
            fillFaculties(data);        
        },"json")
        .fail(() => {
            console.log("Error in fetch");            
        });
    };
    
    return{
        init: () => {
            let page = window.location.pathname;
            if(page.includes('admin/register_user')){
                initAdminRegisterUser();
            }
        }
    }
}

$(document).ready( adminJS().init() );