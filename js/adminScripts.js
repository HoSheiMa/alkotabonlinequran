window.days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

function AutoView(info, Data = null) {


    window.PageStateValue = '';


    switch (info) {
        case 'users':
            window.PageStateValue = 'users';
            users_function();
            return;
        case 'Teachers':
            window.PageStateValue = 'Teachers';
            Teachers_function();
            return;
        case 'ShowSalaryHistory':
            window.PageStateValue = 'ShowSalaryHistory';
            ShowSalaryHistory(Data);
            return;
        case 'Meets':
            window.PageStateValue = 'Meets';
            Meets();
            return;
        case 'Dashboard':
            window.PageStateValue = 'Dashboard';
            Dashboard();
            return;
        case 'Admins':
            window.PageStateValue = 'Admins';
            Admins();
            return;
        case 'moneyCashing':
            window.PageStateValue = 'moneyCashing';
            moneyCashing();
            return;
        case 'Deals':
            window.PageStateValue = "Deals";
            Deals();
            return;
        case 'Links':
            window.PageStateValue = 'Links';
            Links();
            return;



    }



}


function Links() {


     
    $.ajax({
        url : './ajax/helper.php',
        type: 'post',
        data: {
            req: 'getAllLinks',
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');

        },
        success: (d) => {

            d = JSON.parse(d);  


            
            html = `
            
            <div class="row justify-content-center">
            <button onclick="addNewlink()" class="fluid ui blue button">Add New link</button>


        </div>

        <table class="ui celled table">
        <thead>
            <tr><th>Title</th>
            <th>description</th>
            <th>keywords</th>
            <th>visible</th>
            <th>type</th>
            <th>Actions</th>
        </tr></thead>
        <tbody>

        `;


            for (i in d) {


                html += `
                

            <tr>
            <td >${d[i]['title']}</td>
            <td >${d[i]['description']}</td>
            <td >${d[i]['keywords']}</td>
            <td >${d[i]['visible']}</td>
            <td >${d[i]['type']}</td>
            <td>
                <a onclick="Delete_link('${d[i]['id']}')" class="ml-1" style="cursor:pointer">Delete</a>
                <a onclick="edit_link('${d[i]['id']}')" class="ml-1" style="cursor:pointer">edit</a>
            </td>
            </tr>
                `;


            }

            html += ' </tbody> </table>'
            $('.View_admin_contxt').removeClass('loading');
            $('.View_admin_contxt .contxt').html(html);

        }
    });



}

function addNewlink() {

    $('.View_admin_contxt').addClass('loading');

    $.ajax({
        url: './ajax/helper.php',
        type: 'post',
        data: {
            req: 'GetBigTitles',
        },
        success: (d) => {
          var BigTitls = JSON.parse(d);
   


    html = `

        <div class="ui container">

            <form class="ui form" id="newlink" onsubmit="return false">
            <div class="field">
                <label>Title</label>
                <input type="text" name="title" placeholder="Title">
            
            <div class="field">
            <label>description</label>
            <input type="text" name="description" placeholder="description">
        </div>
            <div class="field">
            <label>keywords</label>
            <input type="text" name="keywords" placeholder="keywords">
        </div>
            <div class="inline fields mt-1">
                <label for="fruit">Select your favorite fruit:</label>
            </div>
            <div class="field">
                <div class="ui radio checkbox">
                <input checked="checked" type="radio" name="type" onchange="$('#add-switch-exlink').removeClass('d-none');$('#Located_inBigData').show();$('#add-switch-inlink').addClass('d-none');" value="External_link" checked="" tabindex="0" class="hidden">
                <label>External link</label>
                </div>
            </div>
            <div class="field">
                <div class="ui radio checkbox">
                <input type="radio" name="type" onchange="$('#add-switch-exlink').removeClass('d-none');$('#Located_inBigData').hide();$('#add-switch-inlink').addClass('d-none');" value="BigTitle_link" tabindex="0" class="hidden">
                <label>Big Title link</label>
                </div>
                </div>
            </div>
                <div class="field">
                <div class="ui radio checkbox">
                <input  type="radio" name="type" active onchange="$('#add-switch-inlink').removeClass('d-none');$('#Located_inBigData').show();$('#add-switch-exlink').addClass('d-none')" value="Internal_link" tabindex="0" class="hidden">
                <label>Internal link</label>
                </div>
            </div>
            <select value="NULL" class="ui dropdown" id="Located_inBigData" name="Located_inBigData">
            <option value="Null">No Big Title</option>
              
            ${BigTitls.map((v) => {
                    return `<option value="${v['id']}">${v['title']}</option>`
                })}
                
            </select>
            <div class="ui checkbox mt-1 mb-1">
                <input type="checkbox" name="visible">
                <label>visible</label>
            </div>
            <div class="field" id="add-switch-exlink">
                <label>Put a Link</label>
                <input name="link" type="text">
            </div>

            <div class="field d-none" id="add-switch-inlink">
            <label>Put a contents</label>

            <div id="addnewlinkcode" syle="height:500px">
                <h3>Write You contents here!</h3>
            </div>

            <script>
            var quill = new Quill('#addnewlinkcode', {
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                        ['blockquote', 'code-block'],
                      
                        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                        [{ 'direction': 'rtl' }],                         // text direction
                      
                        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                      
                        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                      
                        ['clean'],                                     // remove formatting button
                        ['link', 'image']  
                      ],
                    },
                theme: 'snow'
              });
            </script>

        </div>

            <button class="ui button" type="submit" onclick="addNewlinkInfo()">Add</button>
        </form>
        
        </div>

        <script>
        $('.ui.radio.checkbox')
  .checkbox()
;</script>


    `;

    




    $('.View_admin_contxt').removeClass('loading');
    $('.View_admin_contxt .contxt').html(html);


         }
    })


}
function addNewlinkInfo() {
    var editorHTML = $('.ql-editor')[0].innerHTML;
    var form  = $('#newlink')[0];
    var formdata = new FormData(form);

    console.log(formdata);

    if (formdata.get('visible') == null) {
        formdata.append('visible', 'off');
    }
    if (formdata.get('type') != 'External_link') {
        formdata.append('code', editorHTML);
    }

    formdata.append('req', 'SetNewLink');

    
    $.ajax({
        url : './ajax/helper.php',
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: formdata,
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');

        },
        success: (d) => {
            console.log(d);
            console.log(formdata);
            window.AutoView('Links')

            
        }
    })

    return false;
}




function Delete_link(id) {

    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure!',
        buttons: {
            confirm: function () {
                $.ajax({
                    url : './ajax/helper.php',
                    type: 'post',
                    data: {
                        req : 'deleteLink',
                        id: id,
                    },
                    success: (d) => {
                        $.alert('Confirmed!');
                        window.AutoView('Links')
                    }
                })            
            },
            cancel: function () {
                $.alert('Canceled!');
            },
           
        }
    });
    
    
}

function edit_link(id) {

    
    $.ajax({
        url: './ajax/helper.php',
        type: 'post',
        data: {
            req: 'GetBigTitles',
        },
        success: (d) => {
          var BigTitls = JSON.parse(d);
   


    
    $.ajax({
        url : './ajax/helper.php',
        type: 'post',
        data: {
            req : 'getInfoLink',
            id: id,

        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');

        },
        success: (d) => {

            d = JSON.parse(d);

            html = `

        <div class="ui container">

            <form class="ui form" id="updatelink" onsubmit="return false">

            <input type="hidden" name="id" value="${id}">
            <div class="field">
                <label>Title</label>
                <input type="text" name="title" value="${d['title']}" placeholder="Title">
            
            <div class="field">
            <label>description</label>
            <input type="text" name="description" value="${d['description']}" placeholder="description">
        </div>
            <div class="field">
            <label>keywords</label>
            <input type="text" name="keywords" value="${d['keywords']}" placeholder="keywords">
        </div>
            <div class="inline fields mt-1">
                <label for="fruit">Select your favorite fruit:</label>
            </div>
                <div class="field">
                <div class="ui radio checkbox">
                <input type="radio" name="type" ${d['type'] == 'Internal_link' ? 'checked':''} onchange="$('#add-switch-inlink').removeClass('d-none');$('#Located_inBigData').show();$('#add-switch-exlink').addClass('d-none')" value="Internal_link" tabindex="0" class="hidden">
                <label>Internal link</label>
                </div>
            </div>
            <div class="field">
                <div class="ui radio checkbox">
                <input type="radio" name="type" ${d['type'] == 'BigTitle_link' ? 'checked':''}  onchange="$('#add-switch-exlink').removeClass('d-none');$('#Located_inBigData').hide();$('#add-switch-inlink').addClass('d-none');" value="BigTitle_link" checked="" tabindex="0" class="hidden">
                <label>Big Title link</label>
                </div>
                </div>
            </div>
            <div class="field">
                <div class="ui radio checkbox">
                <input type="radio" name="type" onchange="$('#add-switch-exlink').removeClass('d-none');$('#add-switch-inlink').addClass('d-none');$('#Located_inBigData').show();" value="External_link" ${d['type'] == 'External_link' ? 'checked':''} tabindex="0" class="hidden">
                <label>External link</label>
                </div>
                </div>
                <select value="NULL" class="ui dropdown ${d['type'] == 'BigTitle_link' ? 'd-none':''}"  id="Located_inBigData" name="Located_inBigData">
                <option value="Null">No Big Title</option>
                ${BigTitls.map((v) => {
                    return `<option value="${v['id']}">${v['title']}</option>`
                })}
                
            </select>


        
            <div class="ui checkbox mt-1 mb-1">
                <input type="checkbox" name="visible" ${d['visible'] == 'on' ? 'checked' : ''}>
                <label>visible</label>
            </div>
            <div class="field ${d['type'] == 'External_link' || d['type'] == 'BigTitle_link' ? '':'d-none'}" id="add-switch-exlink">
                <label>Put a Link</label>
                <input name="link" type="text" ${d['type'] == 'External_link' || d['type'] == 'BigTitle_link'  ? "value='"+ d['code'] + "'" : ''}>
            </div>

            <div class="field ${d['type'] != 'Internal_link' ? 'd-none':''}" id="add-switch-inlink">
            <label>Put a contents</label>

            <div id="addnewlinkcode" syle="height:500px">
            ${d['type'] == 'Internal_link' ? d['code'] : ''}
            </div>

            <script>
            var quill = new Quill('#addnewlinkcode', {
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                        ['blockquote', 'code-block'],
                      
                        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                        [{ 'direction': 'rtl' }],                         // text direction
                      
                        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                      
                        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                      
                        ['clean'],                                     // remove formatting button
                        ['link', 'image']  
                      ],
                    },
                theme: 'snow'
              });
            </script>

        </div>
        <br />

            <button class="ui button"  type="submit" onclick="UpdatelinkInfo()">Update</button>
        </form>
        
        </div>

        <script>
        $('.ui.radio.checkbox')
  .checkbox()
;</script>


    `;




    $('.View_admin_contxt').removeClass('loading');
    $('.View_admin_contxt .contxt').html(html);




            
        }
    })
}});

    
}

function UpdatelinkInfo() {
    

    var editorHTML = $('.ql-editor')[0].innerHTML;
    var form  = $('#updatelink')[0];
    var formdata = new FormData(form);

    if (formdata.get('visible') == null) {
        formdata.append('visible', 'off');
    }
    if (formdata.get('type') != 'External_link') {
        formdata.append('code', editorHTML);
    }

    formdata.append('req', 'updateLink');

    
    $.ajax({
        url : './ajax/helper.php',
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: formdata,
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');

        },
        success: (d) => {
            console.log(d);
            console.log(formdata);
            window.AutoView('Links')

            
        }
    })

    return false;

}



function Deals() {

     
   
    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'GetAllDeals',
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');

        },
        success: (d) => {


            d = JSON.parse(d);

            html = `
            
            <div class="row justify-content-center">
                <button onclick="addNewDeal()" class="fluid ui blue button">Add New Deal</button>


            </div>

            <table class="ui celled table">
            <thead>
                <tr><th>Title</th>
                <th>Info</th>
                <th>price</th>
                <th>Deal Hours</th>
                <th>Times Sells</th>
                <th>Actions</th>
            </tr></thead>
            <tbody>
            `;

            for (i in d) {
                html += `
                
                <tr>
                <td data-label="Name">${d[i]['title']}</td>
                <td data-label="Age">${d[i]['info']}</td>
                <td data-label="Job">${d[i]['Salary']}$</td>
                <td data-label="Job">${d[i]['hours']}</td>
                <td data-label="Job">${JSON.parse(d[i]['json_data']).length}</td>
                <td data-label="Job">
                    <a onclick="Delete_Deal('${d[i]['id']}')" class="ml-1" style="cursor:pointer">Delete</a>
                    <a onclick="edit_edit('${d[i]['id']}', '${d[i]['title']}', '${d[i]['info']}', '${d[i]['Salary']}', '${d[i]['hours']}')" class="ml-1" style="cursor:pointer">edit</a>
                </td>
              </tr>

                `;
            }


            html += `</tbody></table>`;

            $('.View_admin_contxt').removeClass('loading');

            $('.View_admin_contxt .contxt').html(html);
            

        },
    });


}

function addNewDeal() {

    
    $.confirm({
        title: 'add New!',
        content: '' +
        '<form action="" class="formName ui form">' +
        '<div class="field">' +
        `<label>Add new Deal or offer</label>` +
        `
        <input type="text"  placeholder="Title" class="title form-control mt-1" required />
        <input type="text"  placeholder="info" class="info form-control mt-1" required />
        <input type="text"  placeholder="salary" class="salary form-control mt-1" required />
        <input type="text"  placeholder="hours" class="hours form-control mt-1" required />
        
        ` +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var title = this.$content.find('.title').val();
                    if(!title){
                        $.alert('provide a valid title');
                        return false;
                    }

                    var info = this.$content.find('.info').val();
                    if(!info){
                        $.alert('provide a valid info');
                        return false;
                    }


                    var salary = this.$content.find('.salary').val();
                    if(!salary){
                        $.alert('provide a valid salary');
                        return false;
                    }

                    var hours = this.$content.find('.hours').val();
                    if(!hours){
                        $.alert('provide a valid hours');
                        return false;
                    }

                    $.ajax({
                        url: './ajax/meet.php',
                        type: 'post',
                        data: {
                            req: 'add_deal',
                            title: title,
                            info: info,
                            salary: salary,
                            hours: hours,
                        },
                        success: function (d) {

                            console.log(d);
                            $.alert('Done!');
                            
                        },
                    })
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
    

}


function edit_edit(id, title_, info_, salary_, hours_) {


    $.confirm({
        title: 'Edit!',
        content: '' +
        '<form action="" class="formName ui form">' +
        '<div class="field">' +
        `<label>Edit ${title_}</label>` +
        `
        <input type="text" value='${title_}' placeholder="Title" class="title form-control mt-1" required />
        <input type="text" value='${info_}' placeholder="info" class="info form-control mt-1" required />
        <input type="text" value='${salary_}' placeholder="salary" class="salary form-control mt-1" required />
        <input type="text" value='${hours_}' placeholder="hours" class="hours form-control mt-1" required />
        
        ` +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var title = this.$content.find('.title').val();
                    if(!title){
                        $.alert('provide a valid title');
                        return false;
                    }

                    var info = this.$content.find('.info').val();
                    if(!info){
                        $.alert('provide a valid info');
                        return false;
                    }


                    var salary = this.$content.find('.salary').val();
                    if(!salary){
                        $.alert('provide a valid salary');
                        return false;
                    }

                    var hours = this.$content.find('.hours').val();
                    if(!hours){
                        $.alert('provide a valid hours');
                        return false;
                    }

                    $.ajax({
                        url: './ajax/meet.php',
                        type: 'post',
                        data: {
                            req: 'edit_deal',
                            id: id,
                            title: title,
                            info: info,
                            salary: salary,
                            hours: hours,
                        },
                        success: function (d) {

                            console.log(d);
                            $.alert('Done!');
                            
                        },
                    })
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
    

}

function Delete_Deal(id) {

      
   
    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'delete_deal',
            id: id,
        },
       
        success: (d) => {


        }
    });
}

function moneyCashing() {

    
    $.ajax({
        url : './ajax/payment.php',
        type: 'post',
        data: {
            req: 'GetallCashingTeachere',
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');
            

        },

        success : (d) => {

            d = JSON.parse(d);


            html = `
                <div class="row p-3"><h3>List of Money</h3></div>
                <div class="row justify-content-center p-5">
            `;


            for (i in d) {
                di = d[i];


                html += `
                    <div class="col-12 row justify-content-between p-3 text-center cash-card align-items-center">

                        <div>${di[0]}</div>

                        <div class="p-3 border-info text-center btn-cash ">
                            <a
                            
                            ${di[1] == "0" ? 'onclick="return false;"' : `onclick='CashGiven("${di[0]}")'` }
                            >${di[1] == "0" ? 'No cash' : 'cash $' + di[1] }</a>
                        </div>

                    </div>
                `;

                if (d.length == i) {
                    html += '</div>';
                }




            }
            

            

            
            $('.View_admin_contxt').removeClass('loading');

            $('.View_admin_contxt .contxt').html(`${html}`);

        
        }
        
    });

}

function CashGiven(email) {

    $.confirm({
        title: 'Confirm!',
        content: 'Simple request!',
        buttons: {
            confirm: function () {
                $.ajax({
                    url : './ajax/payment.php',
                    type: 'post',
                    data: {
                        req: 'CashGiven',
                        email : email,

                    },
                    beforeSend: () => {

                        $('.View_admin_contxt').addClass('loading');
                    },
                    success: (d) => {

                        console.log(d);
                        

                        $('.View_admin_contxt').removeClass('loading');

                        AutoView(window.PageStateValue);


                    }
                });

                $.alert('Confirmed!');
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });



}

function Admins() {

    

    
    $.ajax({
        url : './ajax/helper.php',
        type: 'post',
        data: {
            req: 'GetallAdmins',
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');
            


        },

        success : (d) => {
            console.log(d);
            $('.View_admin_contxt').removeClass('loading');

            d = JSON.parse(d);



            html = `


            <div class="row justify-content-center m-5">

            <button onclick="createNewAdmin()" class="fluid blue ui button">Create New Admin.</button>


            </div>

            
            <table class="ui celled table">
            <thead>
            <tr>
            <th>Profile Image</th>
            <th>Email</th>
            <th>Name</th>
            <th>Tools</th>
            </tr>
            </thead>
            <tbody>
            `;

            for (i in d) {


                html += `
                
                <tr>
                <td> <img src='${d[i]['profile_img']}' /></td>
                <td>${d[i]['email']}</td>
                <td>${d[i]['name']}</td>
                <td>
                    <div class="ui small basic buttons">
                        <button class="ui button" onclick="UserDelete('${d[i]["email"]}')">Delete</button>
                        <button class="ui button" onclick="EditPermissions('${d[i]["email"]}')">Edit Permissions</button>
                  </div>
                </td>
                </tr>
                `;

            }
            html += `
            </tbody>
            </table>
            `;

            $('.View_admin_contxt .contxt').html(html)





        }
    })
    


}




function Dashboard() {


    
    $.ajax({
        url : './ajax/Dashboard.php',
        type: 'post',
        data: {
            req: 'dashboard',
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');
            


        },

        success : (d) => {

            d = JSON.parse(d);
            console.log(d);

            Views = JSON.parse(d['Views']);
            TotalVeiws = 0;

            labels = [];
            line = [];

            for (i in Views) {

                labels.push(Views[i]['date']);
                line.push(Views[i]['Views']);
                TotalVeiws+= Views[i]['Views']
            }
            console.log(labels, line)





            html = `
        
               <div class="tec-card-title">Total Views</div>
               
                  <h3 id="TotalMeets">${TotalVeiws}</h3>
               
                <canvas style="height: 460px !important; min-height: 460px !important;max-height: 460px !important; display: block;" id="Views"></canvas>
                <div class="row justify-content-center m-5">
                <h3>Website Information</h3></div>
                <form class="ui form" onsubmit="return false;">
            <div class="field">
              <label>WebTitle</label>
              <input type="text" value='${d["WebTitle"]}' name="WebTitle" placeholder="Web Title">
            </div>
            <div class="field">
              <label>description</label>
              <input type="text"  value='${d["description"]}'  name="description" placeholder="description">
            </div>

            <div class="field">
            <label>keywords</label>
            <input type="text"  value='${d["keywords"]}'  name="keywords" placeholder="keywords">
          </div>

          <div class="field">
          <img width=40 src="${d["ico"]}" />
          <label>Choose New Icon</label>
          <input type="file"  name="ico" placeholder="ico">
        </div>

            <div class="field">
              <div class="ui checkbox">
                <input type="checkbox" ${d["WebState"] == 'on' ? 'checked' : ''} tabindex="0" name="WebState" class="hidden">
                <label>Make WebSide off</label>
              </div>
            </div>
            <button class="ui button" onclick="updateDashbourdInfo(this);" type="submit">update</button>
          </form>`;


          $('.View_admin_contxt').removeClass('loading');
          $('.View_admin_contxt .contxt').html(html);

                        $('.ui.checkbox')
                .checkbox()
                ;


          new Chart(document.querySelector('#Views'), {
            "type": "line",
            "data": {
                "labels": labels,
                "datasets": [{
                        "label": "WebSide Views & visiting",
                        "data": line,
                        "fill": true,
                        "borderColor": "rgb(75, 192, 192, .3)",
                        "lineTension": 0.1
                    },
                ],

            },
            "options": {
                "responsive": true,
                "maintainAspectRatio": false,
            }
        });

            

        }
    });


}

function updateDashbourdInfo(e) {

    
    form = $(e).parent()[0];
    form = new FormData(form);
    form.append('req', 'updatedashboard');


      
    $.ajax({
        url : './ajax/Dashboard.php',
        type: 'post',
        data:form,
        cache: false,        
        processData: false,
        contentType: false, // tell jQuery not to set contentType

        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');
            


        },

        success : (d) => {
            console.log(d);
            $('.View_admin_contxt').removeClass('loading');

            AutoView('Dashboard');
        }
    
    })


    
}

function Meets() {


  

    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'MeetsListToJson',
            Time: moment().format('ha'),
            Date : moment().format('D-M-Y'),
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');
            


        },
        success: (d) => {


            var State_color = {
                Missed : '#ff4444',
                Prograss: "#ffbb33",
                "Meet Is Avalible" : "#00C851",
                "preparing a Meet" : "#33b5e5"

            }

            console.log(d);
            
            d = JSON.parse(d);

            

            info = `

            <canvas id="meetsCharts" style="height: 460px !important; min-height: 460px !important;max-height: 460px !important; display: block;"></canvas>
            <div class="row justify-content-center m-5">
                <h3>Meets List</h3>
            </div>

            <table class="ui basic table">
             <thead>
                <tr>
                <th>Teacher email</th>
                <th>student email</th>
                <th>Date</th>
                <th>Time</th>
                <th>State</th>
                <th>trial</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            `;



            dates = [];


            labels = []; // [d,d,d,d] 
            line = [];


            for (i in d) {

                Dateofd1 = new Date((d[i][4]).split("-").reverse().join("-")).getTime();


                dates.push(Dateofd1)
                
                nameteacher = d[i][0];

                date = d[i][4];
                
                t = d[i][2];
                
                id = d[i][5];

                ttz = d[i][6]; // teacher Time zone

                temail  = d[i][7]; // teacher email;
                uemail  = d[i][8]; // user email;
                type  = d[i][9]; // free or not ;

                var local_t = moment.tz(t, 'ha', ttz);

                var local = local_t.clone().tz(moment.tz.guess()).format('ha');

                t = local;

                state = d[i][1];

                btn = state == 'Meet Is Avalible'  ? `<a href='#' style='color: #00C851' onclick=\"EnterMeet('${id}')\"><i class=\"paperclip icon d-inline-block mr-2\" style=\"font-size:18px\"></i>Enter Room</a>`  :  '';


                info += `

                <tr>
                <td>${temail}</td>
                <td>${uemail}</td>
                <td>${date}</td>
                <td>${t}</td>
                <td style='color: ${State_color[state]};'>${state}</td>
                <td>${type == 'free' ? 'true' : 'false'}</td>
                <td>

                ${btn}
                <a href='#' style='color: #ff4444' onclick="CancelMeet('${id}')">Cancel</a>
                </td>
              </tr>
                
                `;

            }

            info += '<tbody></table>'



            dates.sort();

            console.log(dates);

            for (i in dates) {

                // if label is exist : will add all salary in one column
                // linke 1-1-2019 : $10, 1-1-2019 : $11, will mix all salary in same day
                // final salary of day : 21$ 

                label_date = new Date(dates[i]);
                _month = parseInt(label_date.getMonth()) + 1;
                lanel_date_format = label_date.getDate() + "-" + _month + "-" + label_date.getFullYear();


                if (labels.includes(lanel_date_format) == false) {

                    labels.push(
                        lanel_date_format
                        );
                    } 
                
            }


            for (i in d) {
                label_data = 1;
                label_date = d[i][4];
                console.log(label_date)

                for (ii in labels) {
                    if (labels[ii] == label_date) {
                        if (line[ii] == undefined) {
                            line[ii] = label_data;
                        } else {
                            line[ii] += label_data;
                        }
                    }
                }
            }


            console.log(labels, line);
            
                        $('.View_admin_contxt').removeClass('loading');
            
                        $('.View_admin_contxt .contxt').html(info);
            new Chart(document.querySelector('#meetsCharts'), {
                "type": "line",
                "data": {
                    "labels": labels,
                    "datasets": [{
                            "label": "Meets Charts",
                            "data": line,
                            "fill": true,
                            "borderColor": "rgb(75, 192, 192, .3)",
                            "lineTension": 0.1
                        },
                    ],

                },
                "options": {
                    "responsive": true,
                    "maintainAspectRatio": false,
                }
            });


            


        },
    });
    
}

function EnterMeet(id) {
    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'GetAdminLink',
            MeetId : id,
        },
        success: (d) => {
            if (d == "state-not-yet") {

                $.alert({
                    title: 'State of Live not ready yet!',
                    content: 'waiting over 5-10 mins!',
                });
                
            } else {
                window.location.assign(d);

            }

        }
    })
    
}

function Teachers_function() {

    $.ajax({
        url: './ajax/helper.php',
        type: 'post',
        beforeSend: () => {
            $('.View_admin_contxt').addClass('loading');
        },

        data: {
            req: 'GetAllTeachers'
        },
        success: (d) => {

            users_block_length = 0;
            users_active_length = 0;


            d = JSON.parse(d);
            html = `


            <div class="row--" style="margin : 0;padding: 0;">

            <canvas id="TeacherLog"  class="col col-sm-12 col-md-12 col-lg-6 col-xl-6" style="height:460px !important; min-height: 460px !important"></canvas>
            <canvas class="col col-sm-12 col-md-12 col-lg-6 col-xl-6"  id="TeacherRating"  ></canvas>
            

            </div>

            <div class="row-- justify-content-center m-5">
                <button onclick="CreateNewTeacherAccount()" class="fluid ui blue button">Create New Teacher Account!</button>

            </div>

            <table class="ui celled table">
            <thead>
            <tr>
            <th>Profile Image</th>
            <th>Email</th>
            <th>Name</th>
            <th>State</th>
            <th>Work Time From/to</th>
            <th>Work Days</th>
            <th>Salary</th>
            <th>Tools</th>
            </tr>
            </thead>
            <tbody>
            `;

            for (i in d) {


                actWeek = JSON.parse(d[i][3]);

                actWeekString = '';

                for (ioi = 0; ioi < actWeek.length; ioi++) {
                    actWeekString += `${window.days[ioi]}, `;
                } // loop



                (d[i]['BLOCK_STATE'] == 'false') ? users_active_length++ : users_block_length++;

                html += `
                
                <tr>
                <td> <img src='${d[i]['profile_img']}' /></td>
                <td>${d[i]['email']}</td>
                <td>${d[i]['name']}</td>
                <td>${d[i]['BLOCK_STATE'] == 'false' ? '<span class="ui green header">Actived</span>' : '<span class="ui red header">Blocked</span>'}</td>
                <td>${d[i][0]} to ${d[i][1]}</td>
                <td>${actWeekString}</td>
                <td>$${d[i][2]}</td>
                <td>
                        <a class="link-action" onclick="UserDelete('${d[i]["email"]}')">Delete</a>
                        <a class="link-action" onclick="AutoView('ShowSalaryHistory', '${d[i]["email"]}')">Salary Histroy</a>
                        <a class="link-action" onclick="UserBlock('${d[i]["email"]}', '${d[i]["BLOCK_STATE"] == "false" ? "true" : "false"}')">
                        ${d[i]['BLOCK_STATE'] != 'false' ? '<span class="ui green header">Active</span>' : '<span class="ui red header">Block</span>'}
                        </a>
                        <a class="link-action" onclick="UserChangePassword('${d[i]["email"]}')">Change Password</a>
                        <a class="link-action" onclick="ChangeSalary('${d[i]["email"]}')">Change Salary</a>
                        
                        </td>
                </tr>
                `;

            }
            html += `
            </tbody>
            </table>
            `;

            $('.View_admin_contxt .contxt').html(html);


            $('.View_admin_contxt').removeClass('loading');

            $.ajax({
                url: './ajax/helper.php',
                type: 'post',
                data: {
                    req: 'GetTeachersViews'
                },
                success: (dView) => {
                    dView = JSON.parse(dView);

                    console.log(dView);

                    ctx = document.querySelector('#TeacherLog');


                    arrValues = [];
                    arrLabels = [];

                    x = 0;
                    for (view in dView) {
                        arrValues.push(dView[view]['TeacherLoginToday']);
                        arrLabels.push(dView[view]['date']);

                        x = x + 1;

                    }

                    new Chart(ctx, {
                        "type": "line",
                        "data": {
                            "labels": arrLabels,
                            "datasets": [{
                                "label": "Teachers LOGIN HISTORY",
                                "data": arrValues,
                                "fill": true,
                                "borderColor": "rgb(75, 192, 192, .3)",
                                "lineTension": 0.1
                            }]
                        },
                        "options": {
                            "responsive": true,
                            "maintainAspectRatio": false,
                        }
                    });


                }
            })


            $.ajax({
                url: './ajax/helper.php',
                type: 'post',
                data: {
                    req: 'AllTeacherRating'
                },
                success: (dView) => {
                    dView = JSON.parse(dView);

                    console.log(dView);

                    ctx2 = document.querySelector('#TeacherRating');


                    arrValues = [];
                    arrLabels = [];

                    x = 0;
                    for (view in dView) {
                        arrLabels.push(dView[view]['0']);
                        arrValues.push(dView[view]['1']);

                        x = x + 1;

                    }

                    new Chart(
                        ctx2, {
                            "type": "bar",
                            "data": {
                                "labels": arrLabels,
                                "datasets": [{
                                    "label": "Teacher Rating is ",
                                    "data": arrValues,
                                    "fill": false,
                                    "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                                    "borderColor": [
                                        "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                                    ],
                                    "borderWidth": 1
                                }]
                            },
                            "options": {
                                "scales": {
                                    "yAxes": [{
                                        "ticks": {
                                            "beginAtZero": true
                                        }
                                    }]
                                }
                            }
                        });



                }
            })











        }
    })

}




function users_function() {

    $.ajax({
        url: './ajax/helper.php',
        type: 'post',
        beforeSend: () => {
            $('.View_admin_contxt').addClass('loading');
        },
        data: {
            req: 'GetAllUsers'
        },
        success: (d) => {

            users_block_length = 0;
            users_active_length = 0;


            d = JSON.parse(d);
            html = `


            <div class="row--" style="margin : 0;padding: 0;">

            <canvas id="UsersLog"  class="col col-sm-12 col-md-12 col-lg-9 col-xl-9 " style="height:460px !important; min-height: 460px !important"></canvas>
            <div class="col col-sm-12 col-md-12 col-lg-3 col-xl-3 UsersStateBLANK">
                <canvas id="UsersState" class="" ></canvas>
            </div>

            </div>
            
            <table class="ui celled table">
            <thead>
            <tr>
            <th>Profile Image</th>
            <th>Email</th>
            <th>Name</th>
            <th>State</th>
            <th>Tools</th>
            </tr>
            </thead>
            <tbody>
            `;

            for (i in d) {


                (d[i]['BLOCK_STATE'] == 'false') ? users_active_length++ : users_block_length++;

                html += `
                
                <tr>
                <td> <img src='${d[i]['profile_img']}' /></td>
                <td>${d[i]['email']}</td>
                <td>${d[i]['name']}</td>
                <td>${d[i]['BLOCK_STATE'] == 'false' ? '<span class="ui green header">Actived</span>' : '<span class="ui red header">Blocked</span>'}</td>
                <td>
                    <div class="ui small basic buttons">
                        <button class="ui button" onclick="UserDelete('${d[i]["email"]}')">Delete</button>
                        <button class="ui button" onclick="UserBlock('${d[i]["email"]}', '${d[i]["BLOCK_STATE"] == "false" ? "true" : "false"}')">
                        ${d[i]['BLOCK_STATE'] != 'false' ? '<span class="ui green header">Active</span>' : '<span class="ui red header">Block</span>'}
                        </button>
                        <button class="ui button" onclick="UserChangePassword('${d[i]["email"]}')">Change Password</button>
                  </div>
                </td>
                </tr>
                `;

            }
            html += `
            </tbody>
            </table>
            `;

            $('.View_admin_contxt .contxt').html(html);




            $.ajax({
                url: './ajax/helper.php',
                type: 'post',
                beforeSend: () => {
                    $('.View_admin_contxt').toggleClass('loading');
                },
                data: {
                    req: 'GetUsersViews'
                },
                success: (dView) => {
                    dView = JSON.parse(dView);

                    console.log(dView);

                    ctx = document.querySelector('#UsersLog');
                    ctx2 = document.querySelector('#UsersState');


                    arrValues = [];
                    arrLabels = [];

                    x = 0;
                    for (view in dView) {
                        arrValues.push(dView[view]['UserLoginToday']);
                        arrLabels.push(dView[view]['date']);

                        x = x + 1;

                    }

                    new Chart(ctx2, {
                        "type": "doughnut",
                        "data": {
                            "labels": ["Actives Users", "Blocked Users"],
                            "datasets": [{
                                "data": [users_active_length, users_block_length],
                                "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)"]
                            }],
                            "options": {
                                "responsive": true,
                                "maintainAspectRatio": false,
                            }
                        }
                    });


                    new Chart(ctx, {
                        "type": "line",
                        "data": {
                            "labels": arrLabels,
                            "datasets": [{
                                "label": "USERS LOGIN HISTORY",
                                "data": arrValues,
                                "fill": true,
                                "borderColor": "rgb(75, 192, 192, .3)",
                                "lineTension": 0.1
                            }]
                        },
                        "options": {
                            "responsive": true,
                            "maintainAspectRatio": false,
                        }
                    });



                    $('.View_admin_contxt').removeClass('loading');


                }
            })






        }
    })

}


function profile() {

    $('.profile-section').remove();





    $('body').append(`
    
    <div class="profile-section">

        <div class="see--loading">
        <span>Loading...</span>
        </div>

        <div class="wrap">
            <div class="close-btn">
                <i onclick="$(this).parent().parent().parent().remove()" class="arrow right icon"></i>
            </div>

            <div class="profile__img">
                <img />
            </div>

            <div class="u-info">
                <span class="name"></span>
                <span class="Email"></span>
               
                    <div class="ui form" style="display:none">
                    <div class="field">
                        <label>New Password</label>
                        <input type="password" id="newPasswordInput" name="New Password" placeholder="New Password">
                    </div>
                    <button class="ui button" type="submit" onclick="NewPassword()" >Change Now</button>

                    </div>
                    <a  style="margin:5px;" onclick="$(this).prev().show(); $(this).remove()">Change Password</a>

                    <form style="display:none" onchange="NewProfileImage(this)">
                        <input id="profile_img_upload" type="file" name="profile_img">
                    </form>
                    <a style="margin:5px;" onclick="$('#profile_img_upload').click();">Change Profile Image</a>
                
                </div>
            </div>
        </div>

    </div>
    
    `);

    $.ajax({
        url: './ajax/profile.php',
        type: 'post',
        data: {
            req: 'Getinfo',
            type: 'user',

        },
        success: d => {
            d = JSON.parse(d);

            var email = d['email'];
            var name = d['name'];
            var profile_img = d['profile_img'];

            $('.wrap .profile__img img').attr('src', profile_img);
            $('.wrap .u-info .name').text(`${name}`);
            $('.wrap .u-info .Email').text(`${email}`);


            $('.see--loading').hide();
            $('.wrap').show();



        }


    });



}

function NewPassword() {
    p = $('#newPasswordInput').val();
    $.ajax({
        url: './ajax/profile.php',
        type: 'post',
        data: {
            req: 'NewPassword',
            NewPassword: p,
        },
        success: d => {
            $('.profile-section').fadeOut();
        }
    });

}

function NewProfileImage(form) {
    formData = new FormData(form);
    formData.append('req', 'UploadNewImage');

    console.log(formData);


    $.ajax({
        url: './ajax/profile.php',
        type: 'POST',
        data: formData,
        cache: false,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        success: function (data) {
            console.log(data);

            $('.profile-section').fadeOut();

            profile();

        }
    });


}


function UserDelete(email) {
    $.confirm({
        title: 'Are You Sure?',
        content: "You can't return it back!",
        type: 'red',
        alignMiddle: true,
        buttons: {
            confirm: function () {
                $.ajax({
                    url: './ajax/helper.php',
                    type: 'POST',
                    data: {
                        email: email,
                        req: 'RemoveThisUser',
                    },

                    success: function (data) {
                        console.log(data);
                        AutoView(window.PageStateValue);




                    }
                });
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
}

function UserBlock(email, state) {
    $.confirm({
        title: 'Are You Sure?',
        content: "You can return it action back any time!",
        type: 'red',
        alignMiddle: true,
        buttons: {
            confirm: function () {
                $.ajax({
                    url: './ajax/helper.php',
                    type: 'POST',
                    data: {
                        email: email,
                        state: state,
                        req: 'Change_Block_State',
                    },

                    success: function (data) {
                        console.log(data);
                        AutoView(window.PageStateValue);



                    }
                });
            },
            cancel: function () {
                $.alert('Canceled!');
            },
        }
    });
}



function UserChangePassword(email) {

    cpalert = $.confirm({
        title: `Change User ${email} Password!`,
        content: '' +
            '<form action="" class="formName ui form">' +
            '<div class="field">' +
            '<label>Enter something here</label>' +
            '<input type="text" placeholder="New Password" class="pass form-control" required />' +
            '</div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var newpassword = this.$content.find('.pass').val();
                    if (!newpassword) {
                        $.alert('Not valid');
                    }

                    $.ajax({
                        url: './ajax/helper.php',
                        type: 'POST',
                        data: {
                            email: email,
                            NewPassword: newpassword,
                            req: 'NewPassword',
                        },

                        success: function (data) {
                            console.log(data);
                            AutoView(window.PageStateValue);

                            cpalert.close();



                        }
                    });
                    return false;

                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

}


function ChangeSalary(email) {



    cpalert = $.confirm({
        title: `Change User ${email} Salary!`,
        content: '' +
            '<form action="" class="formName ui form">' +
            '<div class="field">' +
            '<label>Enter something here</label>' +
            '<input type="text" placeholder="New Salary" class="Salary form-control" required />' +
            '</div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var Salary = this.$content.find('.Salary').val();
                    if (!Salary) {
                        $.alert('Not valid');
                    }

                    $.ajax({
                        url: './ajax/helper.php',
                        type: 'POST',
                        data: {
                            email: email,
                            Salary: Salary,
                            req: 'NewSalary',
                        },

                        success: function (data) {
                            console.log(data);
                            AutoView(window.PageStateValue);

                            cpalert.close();



                        }
                    });
                    return false;

                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

}


function ShowSalaryHistory(email) {
    if (email == null) return;
    $.ajax({
        url: './ajax/helper.php',
        type: 'post',
        beforeSend: () => {
            $('.View_admin_contxt').addClass('loading');
        },

        data: {
            req: 'GetSalaryHistroy',
            email: email,
        },

        success: (d) => {

            console.log(d);
            d = JSON.parse(d);

            d1 = d[0];
            d2 = d[1];
            d1_d2_times = [];


            for (i in d1) {
                Dateofd1 = new Date((d1[i]['DATE']).split("-").reverse().join("-")).getTime();

                d1[i]['time'] = Dateofd1
                d1_d2_times.push(Dateofd1)

            }

            for (i in d2) {
                Dateofd2 = new Date((d2[i]['DATE']).split("-").reverse().join("-")).getTime();

                d2[i]['time'] = Dateofd2
                d1_d2_times.push(Dateofd2)


            }

            labels = []; // [d,d,d,d] 
            line_d1 = {}; // [1,1,2,3]
            line_d2 = {}; // %


            d1_d2_times.sort();

            for (i in d1_d2_times) {

                // if label is exist : will add all salary in one column
                // linke 1-1-2019 : $10, 1-1-2019 : $11, will mix all salary in same day
                // final salary of day : 21$ 

                // why we use this if() in day & month 
                // when create date by javascript we return values like 2-2-2002
                // but in php return 02-02-2002
                // and this deffrants in values make problem in equal values
                // we fix it by add 0 in first if number between 1-9 but if biger we not add nothing
                label_date = new Date(d1_d2_times[i]);
                _month = parseInt(label_date.getMonth()) + 1; 
                _month = `${_month}`.length == 1 ?  "0"+_month : _month;
                _day = `${label_date.getDate()}`.length == 1 ? "0"+label_date.getDate() : label_date.getDate();

                lanel_date_format = _day + "-" + _month + "-" + label_date.getFullYear();


                if (labels.includes(lanel_date_format) == false) {

                    labels.push(
                        lanel_date_format
                    );
                }

                for (ii in d1) {
                    exist_d1 = false;
                    if (d1[ii]['DATE'] == lanel_date_format) {
                        // console.log(lanel_date_format, d1[ii], line_d1[lanel_date_format]);

                        if (line_d1[lanel_date_format] != undefined) {
                            // console.log('1')

                            line_d1[lanel_date_format] = parseInt(line_d1[lanel_date_format]) + parseInt(d1[ii]['SalaryUsed']);
                        } else {
                            // console.log(line_d1)
                            line_d1[lanel_date_format] = parseInt(d1[ii]['SalaryUsed']);
                            // console.log(line_d1)

                        }



                        exist_d1 = true;



                    }
                }
                if (exist_d1 == false && line_d1[lanel_date_format] == undefined) {

                    line_d1[lanel_date_format] = 0;
                }

                for (ii in d2) {
                    exist_d2 = false;
                    if (d2[ii]['DATE'] == lanel_date_format) {
                        // console.log(lanel_date_format, d2[ii], line_d2[lanel_date_format]);

                        if (line_d2[lanel_date_format] != undefined) {
                            console.log('1')

                            line_d2[lanel_date_format] = parseInt(line_d2[lanel_date_format]) + parseInt(d2[ii]['SalaryTaked']);
                        } else {
                            // console.log(line_d1)
                            line_d2[lanel_date_format] = parseInt(d2[ii]['SalaryTaked']);
                            // console.log(line_d1)

                        }



                        exist_d2 = true;



                    }
                }
                if (exist_d2 == false && line_d2[lanel_date_format] == undefined) {
                    line_d2[lanel_date_format] = 0;
                }


            }



            // console.log(d1, d2, d1_d2_times);
            // console.log(labels, line_d1, line_d2);


            line_1 = [];
            line_2 = [];
            html_ = ``;

            for (i in labels) {
                line_1.push(line_d1[labels[i]]);
                line_2.push(line_d2[labels[i]]);

                html_ += `
                <tr>
                    <td>${labels[i]}</td>
                    <td>${line_d2[labels[i]]}$</td>
                    <td>${line_d1[labels[i]]}$</td>
                </tr>
                `;
            }




            // console.log(labels, line_1, line_2)



            html = `
                <div class="teacher-histroy-section">

                    <div class="text-center">

                        <h3>${email}</h3>

                    </div>
                
                    <canvas id="SalaryHistory"  class="col" style="height:460px !important; max-height: 460px !important"></canvas>

                    <table class="ui selectable celled table">
                        <thead>
                            <tr>
                            <th>Day Date</th>
                            <th>Received From Web</th>
                            <th>Received From Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${html_}
                        </tbody>
                        </table>

                </div>

            `
            $('.View_admin_contxt .contxt').html(html);

            new Chart(document.querySelector('#SalaryHistory'), {
                "type": "line",
                "data": {
                    "labels": labels,
                    "datasets": [{
                            "label": "The amount has been disbursed",
                            "data": line_1,
                            "fill": true,
                            "borderColor": "rgb(75, 192, 192, .3)",
                            "lineTension": 0.1
                        },
                        {
                            "label": "The amount has not been disbursed",
                            "data": line_2,
                            "fill": true,
                            "borderColor": "rgb(75, 192, 92, .3)",
                            "lineTension": 0.1
                        }
                    ],

                },
                "options": {
                    "responsive": true,
                    "maintainAspectRatio": false,
                }
            });

            $('.View_admin_contxt').removeClass('loading');


        }
    })
}

function EditPermissions (email) {

    $.ajax({
        url : './ajax/helper.php',
        type :'post',
        data : {
            req : 'getAdminInfo',
            email: email,
        },
        success: d => {

            console.log(d)
            d = JSON.parse(d);


            permission  = JSON.parse(d['0']);


            cpalert = $.confirm({
                title: `Edit Admin:${email} Account`,
                content: '' +
                    '<form action="" class="create_new_admin ui form">' +
        
                    '<div class="field">' +
                    '<label>Enter Email</label>' +
                    `<input type="email" value="${d['email']}" disabled name="email"  placeholder="Email" class="email form-control" required />` +
                    '</div>' +
        
                    '<div class="field">' +
                    '<label>Enter Password</label>' +
                    '<input type="password" name="pass"  placeholder="Password" class="pass form-control" required />' +
                    '</div>' +
        
        
                    '<div class="field">' +
                    '<label>Enter name</label>' +
                    `<input type="text" name="name" value="${d['name']}"  placeholder="name" class="name form-control" required />` +
                    '</div>' +
        
                    `
                        <div class="ui segment">
                        <div class="field">
                          <div class="ui toggle checkbox">
                            <input type="checkbox" name="Dashboard" ${permission.includes('Dashboard') == true ? 'checked' : ''} tabindex="0" class="hidden">
                            <label>Dashboard Access</label>
                          </div>
                        </div>
                      </div>
        
                      <div class="ui segment">
                      <div class="field">
                        <div class="ui toggle checkbox">
                          <input type="checkbox" name="Students" ${permission.includes('Students') == true ? 'checked' : ''} tabindex="0" class="hidden">
                          <label>Students Access</label>
                        </div>
                      </div>
                    </div>
        
                    <div class="ui segment">
                    <div class="field">
                      <div class="ui toggle checkbox">
                        <input type="checkbox" name="Teachers" ${permission.includes('Teachers') == true ? 'checked' : ''} tabindex="0" class="hidden">
                        <label>Teachers Access</label>
                      </div>
                    </div>
                  </div>
        
                  <div class="ui segment">
                  <div class="field">
                    <div class="ui toggle checkbox">
                      <input type="checkbox" name="Meets" ${permission.includes('Meets') == true ? 'checked' : ''} tabindex="0" class="hidden">
                      <label>Meets Access</label>
                    </div>
                  </div>
                </div>
        
                <div class="ui segment">
                <div class="field">
                  <div class="ui toggle checkbox">
                    <input type="checkbox" name="AdminsAccess" ${permission.includes('Admins-Access') == true ? 'checked' : ''} tabindex="0" class="hidden">
                    <label>Admins Access</label>
                  </div>
                </div>
              </div>

              <div class="ui segment">
              <div class="field">
                <div class="ui toggle checkbox">
                  <input type="checkbox" name="Deals"  ${permission.includes('Deals') == true ? 'checked' : ''} tabindex="0" class="hidden">
                  <label>Deals</label>
                </div>
              </div>
            </div>

            <div class="ui segment">
              <div class="field">
                <div class="ui toggle checkbox">
                  <input type="checkbox" name="Links"  ${permission.includes('Links') == true ? 'checked' : ''} tabindex="0" class="hidden">
                  <label>Links</label>
                </div>
              </div>
            </div>

            
              <script>
              $('.ui.selection.dropdown')
          .dropdown({
            clearable: true
          })
        ;
        
        $('.checkbox')
          .checkbox()
        </script>
                </div>
              
              
              ` +
        
                    '</div>' +
        
                    '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
        
                            var name = this.$content.find('.name').val();
                            if (!name) {
                                $.alert('name Not valid');
                            }
        
                            f = new FormData($('.create_new_admin')[0]);
                            f.append('req', 'editAdmin');
                            f.append('email', email);
                            f.append('tz', moment.tz.guess());
                            console.log(f);
                            $.ajax({
                                url: './ajax/helper.php',
                                type: 'POST',
                                data: f,
                                processData: false,
                                cache : false,
                                contentType: false,
                                success: function (data) {
                                    console.log(data);
                                    AutoView(window.PageStateValue);
        
                                    cpalert.close();
        
        
        
                                }
                            });
                            return false;
        
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });


            



        }
    })
    
}

function CreateNewTeacherAccount() {

    cpalert = $.confirm({
        title: `Create New Teacher Account`,
        content: '' +
            '<form action="" class="create_new_teacher ui form">' +

            '<div class="field">' +
            '<label>Enter Email</label>' +
            '<input type="email" name="email"  placeholder="Email" class="email form-control" required />' +
            '</div>' +

            '<div class="field">' +
            '<label>Enter Password</label>' +
            '<input type="password" name="pass"  placeholder="Password" class="pass form-control" required />' +
            '</div>' +


            '<div class="field">' +
            '<label>Enter name</label>' +
            '<input type="text" name="name"  placeholder="name" class="name form-control" required />' +
            '</div>' +


            '<div class="field">' +
            '<label>Enter info</label>' +
            '<input type="text" name="info" placeholder="info" class="info form-control" required />' +
            '</div>' +


            '<div class="field">' +
            '<label>Enter salary</label>' +
            '<input type="text" name="salary" placeholder="salary" class="salary form-control" required />' +
            '</div>' +


            '<div class="field">' +
            '<label>put cv image</label>' +
            '<input type="file" multiple  name="Profile_cv[]" placeholder="image" class="Profile_cv form-control" required />' +
            '</div>' +

            ` <div class="row-- justify-content-center m-5">
        <a onclick="Insert_newFile(this);return false;" class="fluid ui blue button">+IMAGE!</a>

    </div>` +


            '<div class="field">' +
            '<label>Enter Time From  / to</label>' +
            `<div class="ui selection dropdown m-1">
        <input type="hidden" class="TimeFrom" name="TimeFrom">
        <i class="dropdown icon"></i>
        <div class="default text">active time from</div>
        <div class="menu">
          <div class="item" data-value="0am">0am</div>
          <div class="item" data-value="1am">1am</div>
          <div class="item" data-value="2am">2am</div>
          <div class="item" data-value="3am">3am</div>
          <div class="item" data-value="4am">4am</div>
          <div class="item" data-value="5am">5am</div>
          <div class="item" data-value="6am">6am</div>
          <div class="item" data-value="7am">7am</div>
          <div class="item" data-value="8am">8am</div>
          <div class="item" data-value="9am">9am</div>
          <div class="item" data-value="10am">10am</div>
          <div class="item" data-value="11am">11am</div>
          <div class="item" data-value="0pm">0pm</div>
          <div class="item" data-value="1pm">1pm</div>
          <div class="item" data-value="2pm">2pm</div>
          <div class="item" data-value="3pm">3pm</div>
          <div class="item" data-value="4pm">4pm</div>
          <div class="item" data-value="5pm">5pm</div>
          <div class="item" data-value="6pm">6pm</div>
          <div class="item" data-value="7pm">7pm</div>
          <div class="item" data-value="8pm">8pm</div>
          <div class="item" data-value="9pm">9pm</div>
          <div class="item" data-value="10pm">10pm</div>
          <div class="item" data-value="11pm">11pm</div>
        </div>

      </div>` +
            `<div class="ui selection dropdown m-1">
        <input type="hidden" class="TimeTo" name="TimeTo">
        <i class="dropdown icon"></i>
        <div class="default text">active time to</div>
        <div class="menu">
        <div class="item" data-value="0am">0am</div>
        <div class="item" data-value="1am">1am</div>
        <div class="item" data-value="2am">2am</div>
        <div class="item" data-value="3am">3am</div>
        <div class="item" data-value="4am">4am</div>
        <div class="item" data-value="5am">5am</div>
        <div class="item" data-value="6am">6am</div>
        <div class="item" data-value="7am">7am</div>
        <div class="item" data-value="8am">8am</div>
        <div class="item" data-value="9am">9am</div>
        <div class="item" data-value="10am">10am</div>
        <div class="item" data-value="11am">11am</div>
        <div class="item" data-value="0pm">0pm</div>
        <div class="item" data-value="1pm">1pm</div>
        <div class="item" data-value="2pm">2pm</div>
        <div class="item" data-value="3pm">3pm</div>
        <div class="item" data-value="4pm">4pm</div>
        <div class="item" data-value="5pm">5pm</div>
        <div class="item" data-value="6pm">6pm</div>
        <div class="item" data-value="7pm">7pm</div>
        <div class="item" data-value="8pm">8pm</div>
        <div class="item" data-value="9pm">9pm</div>
        <div class="item" data-value="10pm">10pm</div>
        <div class="item" data-value="11pm">11pm</div>
        </div>

        </div>
       

                        <div class=" mt-2 mb-2">
                <label>Active Days</label>
                <div class="ui fluid multiple search selection dropdown">
                <input type="hidden" name="ActWeeks" class="ActWeeks">
                <i class="dropdown icon"></i>
                <div class="default text">Saved Contacts</div>
                <div class="menu">
                    <div class="item" data-value="1" data-text="Sunday">
                    Sunday
                    </div>
                    <div class="item" data-value="2" data-text="Monday">
                    Monday
                    </div>
                    <div class="item" data-value="3" data-text="Tuesday">
                    Tuesday
                    </div>
                    <div class="item" data-value="4" data-text="Wednesday">
                    Wednesday
                    </div>
                    <div class="item" data-value="5" data-text="Thursday">
                    Thursday
                    </div>
                    <div class="item" data-value="6" data-text="Friday">
                    Friday
                    </div>
                    <div class="item" data-value="7" data-text="Saturday">
                    Saturday
                    </div>
                </div>
                </div>
      
      <script>
      $('.ui.selection.dropdown')
  .dropdown({
    clearable: true
  })
;
</script>
        </div>
      
      
      ` +

            '</div>' +

            '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var email = this.$content.find('.email').val();
                    if (!email) {
                        $.alert('email Not valid');
                    }

                    var pass = this.$content.find('.pass').val();
                    if (!pass) {
                        $.alert('password Not valid');
                    }

                    var Profile_cv = this.$content.find('.Profile_cv').val();
                    if (!Profile_cv) {
                        $.alert('Profile_cv Not valid');
                    }

                    var info = this.$content.find('.info').val();
                    if (!info) {
                        $.alert('info Not valid');
                    }


                    var Salary = this.$content.find('.salary').val();
                    if (!Salary) {
                        $.alert('Salary Not valid');
                    }

                    var name = this.$content.find('.name').val();
                    if (!name) {
                        $.alert('name Not valid');
                    }

                    var TimeFrom = this.$content.find('.TimeFrom').val();
                    if (!TimeFrom) {
                        $.alert('TimeFrom Not valid');
                    }

                    var ActWeeks = this.$content.find('.ActWeeks').val();
                    if (!ActWeeks) {
                        $.alert('ActWeeks Not valid');
                    }

                    var TimeTo = this.$content.find('.TimeTo').val();
                    if (!TimeTo) {
                        $.alert('TimeTo Not valid');
                    }


                    f = new FormData($('.create_new_teacher')[0]);
                    f.append('req', 'AddNewTeacher');
                    f.append('tz', moment.tz.guess());
                    console.log(f);
                    $.ajax({
                        url: './ajax/helper.php',
                        type: 'POST',
                        data: f,
                        cache: false,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function (data) {
                            console.log(data);
                            AutoView(window.PageStateValue);

                            cpalert.close();



                        }
                    });
                    return false;

                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

}


function createNewAdmin() {

    cpalert = $.confirm({
        title: `Create New Admin Account`,
        content: '' +
            '<form action="" class="create_new_admin ui form">' +

            '<div class="field">' +
            '<label>Enter Email</label>' +
            '<input type="email" name="email"  placeholder="Email" class="email form-control" required />' +
            '</div>' +

            '<div class="field">' +
            '<label>Enter Password</label>' +
            '<input type="password" name="pass"  placeholder="Password" class="pass form-control" required />' +
            '</div>' +


            '<div class="field">' +
            '<label>Enter name</label>' +
            '<input type="text" name="name"  placeholder="name" class="name form-control" required />' +
            '</div>' +

            `
                <div class="ui segment">
                <div class="field">
                  <div class="ui toggle checkbox">
                    <input type="checkbox" name="Dashboard" tabindex="0" class="hidden">
                    <label>Dashboard Access</label>
                  </div>
                </div>
              </div>

              <div class="ui segment">
              <div class="field">
                <div class="ui toggle checkbox">
                  <input type="checkbox" name="Students" tabindex="0" class="hidden">
                  <label>Students Access</label>
                </div>
              </div>
            </div>

            <div class="ui segment">
            <div class="field">
              <div class="ui toggle checkbox">
                <input type="checkbox" name="Teachers" tabindex="0" class="hidden">
                <label>Teachers Access</label>
              </div>
            </div>
          </div>

          <div class="ui segment">
          <div class="field">
            <div class="ui toggle checkbox">
              <input type="checkbox" name="Meets" tabindex="0" class="hidden">
              <label>Meets Access</label>
            </div>
          </div>
        </div>

        <div class="ui segment">
        <div class="field">
          <div class="ui toggle checkbox">
            <input type="checkbox" name="AdminsAccess" tabindex="0" class="hidden">
            <label>Admins Access</label>
          </div>
        </div>
      </div>

      <div class="ui segment">
        <div class="field">
          <div class="ui toggle checkbox">
            <input type="checkbox" name="Deals" tabindex="0" class="hidden">
            <label>Deals</label>
          </div>
        </div>
      </div>


      <div class="ui segment">
      <div class="field">
        <div class="ui toggle checkbox">
          <input type="checkbox" name="Links" tabindex="0" class="hidden">
          <label>Links</label>
        </div>
      </div>
    </div>
      
      
      <script>
      $('.ui.selection.dropdown')
  .dropdown({
    clearable: true
  })
;

$('.checkbox')
  .checkbox()
</script>
        </div>
      
      
      ` +

            '</div>' +

            '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var email = this.$content.find('.email').val();
                    if (!email) {
                        $.alert('email Not valid');
                    }

                    var pass = this.$content.find('.pass').val();
                    if (!pass) {
                        $.alert('password Not valid');
                    }


                    var name = this.$content.find('.name').val();
                    if (!name) {
                        $.alert('name Not valid');
                    }

                    f = new FormData($('.create_new_admin')[0]);
                    f.append('req', 'AddAdmin');
                    f.append('tz', moment.tz.guess());
                    console.log(f);
                    $.ajax({
                        url: './ajax/helper.php',
                        type: 'POST',
                        data: f,
                        processData: false,
                        cache : false,
                        contentType: false,
                        success: function (data) {
                            console.log(data);
                            AutoView(window.PageStateValue);

                            cpalert.close();



                        }
                    });
                    return false;

                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

}

function Insert_newFile(e) {
    $(e).parent().prev().after(`
    <div class="field">
    <label>put cv image
    <a class="mini negative ui button" onclick="$(this).parent().parent().remove()">
        delete
        </a>
    </label>
    <input type="file" multiple  name="Profile_cv[]" placeholder="Email" class="Profile_cv form-control" required />
    </div>
    `);
}

AutoView('Dashboard');