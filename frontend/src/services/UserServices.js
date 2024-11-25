import Api from "@/http/Api";

export default {
    /**
    * Função Busca dados de um usuário
    * Se estiver logado portado (Bearer) do token
    */
    async fetchUser(userId, token) {
        try {

            const response = await Api().get(`/users/${userId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
            return response.data.user;
        } catch (error) {
            console.error("Erro ao buscar usuário:", error);
            throw error;
        }
    },

    /**
    * Atualiza Edita os Dados de um usuário
    * Se estiver logado portado (Bearer) do token
    */
    async updateUser(userData, token) {
        try {
            const response = await Api().patch('/users/profile', userData, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
            return response.data.message;
        } catch (error) {
            console.error("Erro ao atualizar usuário:", error);
            throw error;
        }
    },

    //Logar usuario
    async userLogin(email, password) {
        try {
            const response = await Api().post('/users/login', {
                email,
                password

            });
            return response.data.token;
        } 
        catch (error) {
            console.error("Erro ao logar usuário:", error);
        }
    }
}  
