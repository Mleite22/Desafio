
import axios, { type AxiosInstance } from 'axios';

const createAxiosInstance = (): AxiosInstance => {
    const token = localStorage.getItem("token");
    return axios.create({
        baseURL: "http://127.0.0.1:8000/api",
        headers: {
            Authorization:token ? `Bearer ${token}` : "",
            Accept: "application/json",
        },
        withCredentials: true,
    });
};

export default createAxiosInstance;