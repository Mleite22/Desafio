/**
 * Api de conexão com o Back end
 */ 

import axios from "axios";

export default () => axios.create ({
    
    //'baseURL' do Back-end -> fará a comunicação do front com o Back
    baseURL: "http://127.0.0.1:8000/api",
    
});

