let counterfield = 0
$(".fielAppender").click((e) => {
    const target_div = $(e.target).attr("data-append");
    const field_name = (target_div == 'emailDiv') ? 'Enter Email Adderss' : 'Enter telephone Number'
    const type_name = (target_div == 'emailDiv') ? 'email' : 'text'
    const input_name = (target_div == 'emailDiv') ? 'email[]' : 'phone[]'
    $("#"+target_div).append(`
        <div class="row mb-3" id="`+type_name+counterfield+`">
            <div class="col-md-10">
                <input name="`+input_name+`" required type="`+type_name+`" placeholder="`+field_name+`" class="form-control">
            </div>
            <div class="col-md-2">
                <button onclick="removeRow('`+type_name+counterfield+`')" type="button" class="btn btn-danger btn-sm col-md-12 mt-1 font-weight-bold">X</button>
            </div>
        </div>
    `)

    counterfield++;
    window.scrollTo(0,document.getElementsByTagName("body")[0].clientHeight)
})

const removeRow = (id) => {
    $("#"+id).remove()
}