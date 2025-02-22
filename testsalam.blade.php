import React from 'react'
import styles from  './TeacherSignUp.module.css'
import ImgSignUp from "../../assets/SignUp.svg"
export default function TeacherSignUp() {
  return (
    <div className="min-h-screen flex justify-center items-center bg-gray-100">
                      <div className="backdrop-blur-lg bg-white/30 shadow-lg rounded-3xl overflow-hidden flex  max-w-5xl border-8 border-white/20">
                       
                        <div className="w-1/2 bg-green-50/80 flex flex-col justify-center items-center p-8">
                          <img
                            src={ImgSignUp}
                            alt="Meditation"
                            className="rounded-full w-[700px] mb-4"
                          />
                          <h2 className="text-2xl font-semibold main-color">
                            Relax and Focus
                          </h2>
                          <p className="main-color text-center mt-2">
                            Connect with your inner self and find peace.
                          </p>
                        </div>

                      
                        <div className="w-1/2 p-8 flex flex-col justify-center pt-12">
                          <h2 className="text-3xl font-semibold text-[#F39F5F] mb-2">
                            Welcome back!
                          </h2>
                          <p className="main-color text-sm mb-8">
                          Start your website in seconds. Already have an account? <span className='text-blue-700'>Login here.</span> 
                          </p>

                          <form className="w-full max-w-md">
                            <div className='flex justify-between items-center space-x-3 '>
                               <div className="mb-4">
                                    <label htmlFor="name" className="block text-sm font-medium main-color mb-2 ">
                                    Your email
                                    </label>
                                    <div className="flex justify-center items-center border border-gray-300 rounded-md shadow-sm">
                                         <i class="fa-regular fa-envelope text-xl ps-2 w-12 main-color"></i>
                                         <input
                                            type="text"
                                            id="name"
                                            placeholder="e.g. Bonnie Green"
                                            className=" w-full -ms-2 px-4 py-2 border-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                          />
                                    </div>
                                   
                                </div>
                               <div className="mb-4">
                                    <label htmlFor="name" className="block text-sm font-medium main-color mb-2">
                                    Your email
                                    </label>
                                    <div className="flex justify-center items-center border border-gray-300 rounded-md shadow-sm">
                                          <i class="fa-solid fa-unlock-keyhole text-lg ps-2 w-12 main-color"></i>
                                          <input
                                            type="password"
                                            id="password"
                                            placeholder=""
                                            className=" bg-[#F9FAFB] flex justify-center items-center w-full px-4 py-2 border-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder:text-xl placeholder:pt-"
                                          />
                                          <i class="fa-regular fa-eye main-color pe-3"></i>
                                    </div>
                                   
                                </div>

                            </div>
                            <div className="mb-4">
                                      <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                                      <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Choose a country</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                      </select>
                            </div>
                            <div className="flex items-center">
                                            <div className="flex-1 border-t border-gray-300"></div>
                                            <span className="mx-4 text-gray-500">
                                               or
                                            </span>
                                            <div className="flex-1 border-t border-gray-300"></div>
                             </div>
                             <div>
                             <button type="button" class="mt-3 w-full text-center flex justify-center items-center text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2">
                                         <i class="fa-brands fa-google me-3"></i>
                                          Connect with MetaMask
                              </button>
                             <button type="button" class="mb-3 w-full text-center flex justify-center items-center text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2">
                                           <i class="fa-brands fa-apple me-3 text-lg"></i>
                                          Connect with MetaMask
                              </button>
                              <div className="mb-6">
                                    <label className="flex items-start space-x-2">
                                      <input type="checkbox" className="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                      <span className="text-gray-500">
                                        By signing up, you agree to our <a href="#" className="text-blue-600 hover:underline">Terms</a> and <a href="#" className="text-blue-600 hover:underline">Privacy Policy</a>.
                                      </span>
                                    </label>
                                  </div>
                             </div>
                             
                              
                              <button
                                type="button"
                                className="mb-6 w-full px-3 py-2 bg-[#F39F5F] text-white rounded-md shadow-sm hover:bg-[#F39F5F] focus:outline-none focus:ring-2 focus:ring-blue-500"
                              >
                                Create an account
                              </button>
                           </form>






                            
             

                         
                        </div>
                      </div>
     </div>

  );
};