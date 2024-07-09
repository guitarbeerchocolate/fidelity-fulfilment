import axios from "axios";

const API_URL = "http://localhost:8000/api"; // Replace with your backend API URL

export const register = (name, email, password) => {
  return axios.post(`${API_URL}/register`, {
    name,
    email,
    password,
    password_confirmation: password,
  });
};

export const login = (email, password) => {
  return axios.post(`${API_URL}/login`, {
    email,
    password,
  });
};
