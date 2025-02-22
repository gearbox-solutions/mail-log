import type Model from "@/Types/Model";

type Mail = Model & {
    from_email: string;
    from_name: string | null;
    to_email: string;
    to_name: string | null;
    subject: string;
    content_html: string;
    content_text: string;
    headers: string | null;
    mailer: string | null;
    sent_at: string;
    status: string;
    error_message: string | null;
    text: string | null;
    attachments: Array<{
        id: number;
        filename: string;
        size: number;
        content_type: string;
    }>;
};

export default Mail;
