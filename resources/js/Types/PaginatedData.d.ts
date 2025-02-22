import type PaginatedDataLink from "@/Types/PaginatedDataLink";

export default interface PaginatedData<Type> {
    current_page: number;
    data: Type[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginatedDataLink[];
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url: string;
    to: number;
    total: number;
}
