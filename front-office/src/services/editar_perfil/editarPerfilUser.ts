import createAxiosInstance from "@/utils/axios";

interface UserProfile {
  id: number;
  name: string;
  email: string;
  password?: string;  // Senha opcional
  
}

async function editarPerfilUser(userData: UserProfile) {
  const axiosInstance = createAxiosInstance();
  try {
    const response = await axiosInstance.patch("/users/profile", userData);
    return response.data;
  } catch (error) {
    console.error("Erro da requisição", error);
    throw error;
  }
}

export default editarPerfilUser;
