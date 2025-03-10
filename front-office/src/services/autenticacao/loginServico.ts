import createAxiosInstance from "@/utils/axios";


async function autenticUser(email: string, password: string) {
    try {
        const store = createAxiosInstance();
        const response = await store.post("/login", {
            email,
            password,
        });
        return response.data;
    } catch (error) {
        throw error;
    }
}

export default { autenticUser }