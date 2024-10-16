<template>
    <div class="sidbar">
        <div class="avatar-top">
            <div class="avatar">
                <span><i class="fa fa-user"></i></span>
            </div>
            <div class="avatar-nome">
                <p>Marcos{{name}}</p>
            </div>
        </div>
        <hr>
        <div class="menu">
            <ul>
                <a href=""><li>Matricula</li></a>
                <a href=""><li>Cursos</li></a>
                <a href=""><li>Lista de curso</li></a>
                <a href=""><li>Alunos Matriculados</li></a>
                
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    name: 'SidBarComponent',
}
</script>

<style src="./styleComponets.css" />

<!-- <style scoped>
.sidbar{
    margin-top: 10px;
    

    .avatar-top{
        width: 100%;
        margin-top: 20px;
        display: flex;
        justify-content: center;
        /* background-color: brown; */
        align-items: center;
        padding-top: 10px;
        
        span{
            width: 50px;            
            height: 50px;
            border-radius: 50%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .avatar-nome{
            margin-left: 8px;
            font-size: 13px;
        }
    }
    .menu{
        margin-top: 50px;
        font-size: 15px;        
        padding: 10px;
        
        ul{
            justify-content: center;
            list-style: none;
            
            a {                
                li{
                    font-size: 15px;
                    font-weight: 400;
                    color: #fff;
                    padding: 10px;
                    transition: 0.2s;
                }
                li:hover{
                    background-color: rgba(99, 10, 99, 0.76);
                    border-radius: 5px;
                    
                }
            }  
        }
    }

    hr{
        margin-top: 30px;
        border-color: rgba(211, 214, 214, 0.452);
    }
}
</style> -->