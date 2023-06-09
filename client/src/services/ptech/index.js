import axios from "axios";
import {useAuthStore} from "@/stores/auth";
import auth from "@/services/ptech/auth";
import flight from "@/services/ptech/flight";
import gallery from "@/services/ptech/gallery";
import system_config from "@/services/ptech/system_config";
import upload from "@/services/ptech/upload";
import kanban from "@/services/ptech/kanban";

const http = axios.create({
    baseURL: import.meta.env.VITE_PTECH_BASE_URL,
    headers: {
        "Content-Type": "application/json"
    }
});

http.interceptors.request.use((config) => {

    // Check and add token
    const token = useAuthStore().getTokenString();
    if (!!token) {
        config.headers["Authorization"] = token;
    }

    return config;
}, (err) => {
    return Promise.reject(err);
});

export const usePTechAuth = () => auth(http);
export const usePTechFlight = () => flight(http);
export const useGallery = () => gallery(http);

export const useSystemConfig = () => system_config(http);

export const useUpload = () => upload(http);
export const useKanban = () => kanban(http);