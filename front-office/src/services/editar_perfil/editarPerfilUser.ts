import createAxiosInstance from "@/utils/axios";


async function editarPerfilUser(userData) {
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
