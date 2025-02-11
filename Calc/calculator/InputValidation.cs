using System;

namespace SimpleCalculator
{
    /// <summary>
    /// A static class that handles user input validation.
    /// </summary>
    static class InputValidation
    {
        /// <summary>
        /// Prompts the user for a valid number and ensures input is numeric.
        /// </summary>
        /// <param name="prompt">The message displayed to the user.</param>
        /// <returns>A valid double value entered by the user.</returns>
        public static double GetValidNumber(string prompt)
        {
            double number;
            while (true)
            {
                Console.Write(prompt); // Display the prompt message
                if (double.TryParse(Console.ReadLine(), out number))
                {
                    return number; // Return valid number
                }
                Console.WriteLine("Invalid input. Please enter a valid number."); // Error message for invalid input
            }
        }
    }
}
