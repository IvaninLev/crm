import axios from "../plugins/axios.js";

class AuthService {
    async login({email, password, remember}) {
        return await axios.post('login', {email, password, remember})
            .then(response => response.data)
    }

    async register({name, email, password, password_confirmation, remember}) {
        return await axios.post('register', {
            name,
            email,
            password,
            password_confirmation,
            remember
        }).then(response => response.data)
    }
}


export default  new AuthService()
