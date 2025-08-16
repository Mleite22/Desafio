import createAxiosInstance from "@/utils/axios";


async function getCursoAluno() {
    try {
        const store = createAxiosInstance();
        const response = await store.get("/cursoaluno");
        return response.data;
    } catch (error) {
        throw error;
    }
}

export default { getCursoAluno };