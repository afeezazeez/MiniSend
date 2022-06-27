export function makePagination(current_page, last_page, prev_page_url, next_page_url, total) {
    let pagination = {
        current_page: current_page,
        last_page: last_page,
        next_page_url: next_page_url,
        prev_page_url: prev_page_url,
        total_result: total
    }
    return pagination
}

export function extensionIsValid(filename) {
    let allowedFileTypes = [
        'jpg',
        'png',
        'jpeg',
        'pdf',
        'docx'
    ];

    let parts = filename.split('.');
    let ext = parts[parts.length - 1];

    if (allowedFileTypes.includes(ext)) {
        return true;
    }

    return false;

}












