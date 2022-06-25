
export function makePagination(meta,links) {
    let pagination = {
        current_page : meta.current_page,
        last_page:meta.last_page,
        next_page_url:links.next,
        prev_page_url :links.prev,
        total_result:meta.total
    }
    return pagination
 }

 export function extensionIsValid(filename) {
    let allowedFileTypes =[
        'jpg',
        'png',
        'jpeg',
        'pdf',
        'docx'
    ];

    let parts = filename.split('.');
    let ext=  parts[parts.length-1];

    if(allowedFileTypes.includes(ext)){
        return true;
    }

    return false;

 }









