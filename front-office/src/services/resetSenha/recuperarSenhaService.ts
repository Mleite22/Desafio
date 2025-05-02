import createAxiosInstance from "@/utils/axios";

async function recuperarSenha( email: string ) {
    const axiosInstance = createAxiosInstance();
    const response = await axiosInstance.post("/forgot-password-code", {
        email,
        
    });
    return response.data;
}
// Valida o código de recuperação
async function validarCodigo( email: string, codigo: string ) {
    const axiosInstance = createAxiosInstance();
    const response = await axiosInstance.post("/reset-password-validate-code", {
        email,
        code: codigo,
    });
    return response.data;
}
// atualiza a senha
async function atualizarSenha( email: string, codigo: string, password: string ) {
    const axiosInstance = createAxiosInstance();
    const response = await axiosInstance.post("/reset-password-code", {
        email,
        code: codigo,
        password: password,
    });
    return response.data;
}
export default { recuperarSenha, validarCodigo, atualizarSenha };