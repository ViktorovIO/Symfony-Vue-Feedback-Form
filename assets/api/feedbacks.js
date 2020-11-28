import axios from "axios";

export default {
    // create(message) {
    //     return axios.post("/api/posts", {
    //         message: message
    //     });
    // },
    getFeedbackList() {
        return axios.get("/api/feedbackList");
    }
};