/**
 * axios
 * Api de conexão com o Back end
 */ 

import axios, { type AxiosInstance } from 'axios';

const createAxiosInstance = (): AxiosInstance => {
    return axios.create({
        baseURL: "http://127.0.0.1:8000/api",
    });
};

export default createAxiosInstance;