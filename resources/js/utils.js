
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




