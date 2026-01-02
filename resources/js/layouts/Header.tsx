import MiniCartDropDown from '@/components/MiniCartDropDown';
import { logout } from '@/routes';
import { SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import { useEffect, useRef, useState } from 'react';

export default function Header({ title }: { title: string | null }) {
    const appName = import.meta.env.VITE_APP_NAME;
    const { error, success } = usePage<SharedData>().props;

    const [successMessage, setSuccessMessage] = useState([]);
    //Ref to store timeouts for each message
    const timeOutRef = useRef<{ [key: number]: ReturnType<typeof setTimeout> }>(
        {},
    );

    useEffect(() => {
        if (success.message) {
            const newMessage = {
                ...success,
                id: success.time, // use time as unique identifier
            };

            //Add the new message to the list
            setSuccessMessage((prevMessages): any => [
                newMessage,
                ...prevMessages,
            ]);

            //set a timeout for specific message
            const timeoutId = setTimeout(() => {
                //use a functionl update to ensure the latest state is used
                setSuccessMessage((prevMessages) =>
                    prevMessages.filter((msg: any) => msg.id !== newMessage.id),
                );
                //clear timeout from refs after execution
                delete timeOutRef.current[newMessage.id];
            }, 5000);

            //Store timeout id in the ref
            timeOutRef.current[newMessage.id] = timeoutId;
        }
    }, [success]);

    return (
        <div>
            <Head title={title ? title : appName}></Head>

            <div className="navbar bg-base-100 shadow-sm">
                <div className="flex-1">
                    <a href="/" className="btn text-xl btn-ghost">
                        Laravel Ecomm
                    </a>
                </div>
                <div className="flex-none">
                    <MiniCartDropDown />
                    <div className="dropdown dropdown-end">
                        <div
                            tabIndex={0}
                            role="button"
                            className="btn avatar btn-circle btn-ghost"
                        >
                            <div className="w-10 rounded-full">
                                <img
                                    alt="Tailwind CSS Navbar component"
                                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                                />
                            </div>
                        </div>
                        <ul className="dropdown-content menu z-1 mt-3 w-52 menu-sm rounded-box bg-base-100 p-2 shadow">
                            {/* <li>
                                    <a className="justify-between">
                                        Profile
                                        <span className="badge">New</span>
                                    </a>
                                </li>
                                <li>
                                    <a>Settings</a>
                                </li> */}
                            <li>
                                <Link href={logout()}>Logout</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {successMessage.length > 0 && (
                <div className="toast toast-end toast-top z-[1000] mt-16">
                    {successMessage.map((msg: any) => (
                        <div className="alert alert-success" key={msg.id}>
                            <span>{msg.message}</span>
                        </div>
                    ))}
                </div>
            )}

            {error && (
                <div className="p-8 text-red-500">
                    <div className="alert alert-error">{error}</div>
                </div>
            )}
        </div>
    );
}
