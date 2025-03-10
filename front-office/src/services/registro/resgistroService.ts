import createAxiosInstance from "@/utils/axios";

interface RegistroPayload {
    name: string;
    email: string;
    password: string;
}

interface RegistroResponse {
    user: {
        id: number;
        name: string;
        email: string;
    };
    token: string;
}

async function registerUser(payload: RegistroPayload
): Promise<RegistroResponse>
{
    try {
        const axiosInstance = createAxiosInstance();
        const response = await axiosInstance.post('/users', payload);
        return response.data;
    } catch (error) {
        throw error;
    }

}

export default { registerUser }  