import createAxiosInstance from "@/utils/axios";

async function registerUser( name: string, email: string, password: string ) {
    const axiosInstance = createAxiosInstance();
    const response = await axiosInstance.post("/users", {
        name,
        email,
        password,
    });
    return response.data;
}
export default { registerUser };